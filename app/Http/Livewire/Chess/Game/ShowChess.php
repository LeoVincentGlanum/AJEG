<?php

namespace App\Http\Livewire\Chess\Game;

use App\Http\Livewire\Chess\Game\Traits\HasGameResultMapperChess;
use App\Http\Livewire\Traits\HasToast;
use App\Models\Bet;
use App\Models\Elo;
use App\Models\Game;
use App\Models\GamePlayer;
use App\Models\TournamentParticipant;
use App\Models\User;
use App\ModelStates\BetStates\LooseBet;
use App\ModelStates\BetStates\WinBet;
use App\ModelStates\GamePlayerResultStates\Loss;
use App\ModelStates\GamePlayerResultStates\Draw;
use App\ModelStates\GamePlayerResultStates\Pat;
use App\ModelStates\GamePlayerResultStates\Win;
use App\ModelStates\GameStates\GameAccepted;
use App\ModelStates\GameStates\InProgress;
use App\ModelStates\GameStates\PlayersValidation;
use App\ModelStates\GameStates\Validate;
use App\ModelStates\PlayerParticipationStates\Pending;
use App\ModelStates\PlayerRecognitionResultStates\Accepted;
use App\ModelStates\PlayerRecognitionResultStates\Pending as PlayerRecognitionResultStatesPending;
use App\Notifications\GameAcceptedNotification;
use App\Notifications\GameAcceptedSendedNotification;
use App\Notifications\GameDeclinedNotification;
use App\Notifications\GameLaunchedNotification;
use App\Notifications\RankingEloUpdateNotification;
use App\Notifications\RankingEloWinnerUpdateNotification;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ShowChess extends Component
{

    use HasGameResultMapperChess, HasToast;

    public Game $game;

    public bool $isBetAvailable = false;
    public ?GamePlayer $winner;
    public Collection $gamePlayer;

    public ?GamePlayer $currentUserGame = null;

    public bool $canBeBet = false;
    public bool $canBeDelete = true;

    public string $CurrentState;
    protected $listeners = [
        'refresh' => '$refresh',
        'refreshListPlayer'
    ];

    public function mount($game)
    {
        $this->game = $game;
        $this->gamePlayer = $game->gamePlayers;
        $this->winner = $game->gamePlayers->toQuery()->where('result', '=', 'win')->first();
        if ($this->gamePlayer->where('user_id', '=', Auth::id())->first()) {
            $this->currentUserGame = $this->gamePlayer->where('user_id', '=', Auth::id())->first();
        }
        $this->isBetAvailable = $game->bet_available
            && empty(Bet::query()->where('game_id', $game->id)->where('gambler_id', Auth::id())->first())
            && in_array($game->status, [PlayersValidation::$name, GameAccepted::$name]);

        $this->canBeBet = !in_array(Auth::user()->id, $this->game->users->pluck('id')->toArray());

        if($game->status::$name === 'validate'){
            $this->canBeDelete = false;
        }
    }

    //accept() permet d'accepter les résultats d'une partie
    public function accept()
    {
        try {
            $gameBets = Bet::query()->with('user')->where('game_id', $this->game->id)->get();

            $users = $this->game->gamePlayers;

            $winner = null;
            $looser = null;

            foreach ($users as $player) {
                if ($player->result->equals(Win::class)) {
                    $winner = $player;
                    continue;
                }

                $looser = $player;
            }

            $eloJ1 = Elo::query()->where('user_id', Arr::get($users, 0)->user->id)->where('sport_id', 1)->first()->elo;
            $eloJ2 = Elo::query()->where('user_id', Arr::get($users, 1)->user->id)->where('sport_id', 1)->first()->elo;

            $result = $this->newRatings($eloJ1, $eloJ2, Arr::get($users, 0), Arr::get($users, 1));

            Elo::query()->where('user_id', Arr::get($users, 0)->user->id)->where('sport_id', 1)->first()->update(['elo' => $result[0]]);
            Elo::query()->where('user_id', Arr::get($users, 1)->user->id)->where('sport_id', 1)->first()->update(['elo' => $result[1]]);

            $allCompleted = true;
            foreach ($this->gamePlayer as $player) {
                if ($player->user_id === Auth::id()) {
                    $player->player_result_validation->transitionTo(Accepted::class);
                    $player->save();
                }
                //Ajout du résultat dans la table tournament_participants au cas où la game fait partie d'un tournoi
                if ($this->game->tournament_id !== null) {
                    $tournamentParticipant = TournamentParticipant::query()
                        ->where('user_id', $player->user_id)
                        ->where('tournament_id', $this->game->tournament_id)
                        ->firstOrFail();
                    if ($player->result->equals(Draw::class)) {
                        $tournamentParticipant->draws++;
                    }
                    if ($player->result->equals(Pat::class)) {
                        $tournamentParticipant->pats++;
                    }
                    if ($player->result->equals(Win::class)) {
                        $tournamentParticipant->wins++;
                    }
                    if ($player->result->equals(Loss::class)) {
                        $tournamentParticipant->losses++;
                    }
                    $tournamentParticipant->save();
                }
                if ($player->player_result_validation->equals(PlayerRecognitionResultStatesPending::class)) {
                    $allCompleted = false;
                }
            }

            if ($allCompleted) {
                $this->game->status->transitionTo(Validate::class);
                if ($looser !== null && $this->game->save()) {
                    foreach ($gameBets as $bet) {
                        if ($bet->gameplayer_id === $looser->id) {
                            $bet->bet_status->transitionTo(LooseBet::class);
                            $bet->save();
                        }
                    }

                    $userToNotify = User::find($looser->user_id);
                    $userToNotify->notify(new RankingEloUpdateNotification($userToNotify));
                }
                if ($winner !== null && $this->game->save()) {
                    foreach ($gameBets as $bet) {
                        if ($bet->gameplayer_id === $winner->id) {
                            User::query()
                                ->where('id', $bet->gambler_id)
                                ->increment('coins', $bet->bet_gain);
                            $bet->bet_status->transitionTo(WinBet::class);
                            $bet->save();
                        }
                    }
                    $userToNotify = User::find($winner->user_id);
                    $userToNotify->notify(new RankingEloWinnerUpdateNotification($userToNotify));
                }
            }

            $this->dispatchBrowserEvent('toast', ['message' => __("You approved the result !"), 'type' => 'success']);

            redirect()->route('chess.dashboard');
        } catch (Exception $e) {
            report($e);
            $this->errorToast('quelque chose s\'est mal passé');
        }
    }

    function expectedScore($rating1, $rating2)
    {
        return 1 / (1 + pow(10, ($rating2 - $rating1) / 400));
    }

    function newRatings(float $rating1, float $rating2, $score1, $score2)
    {
        $K = $this->valeur_k($rating1 + $rating2 / 2);
        $expected1 = $this->expectedScore($rating1, $rating2);
        $expected2 = $this->expectedScore($rating2, $rating1);

        $newRating1 = $rating1 + $K * ($this->getScoreWithResult($score1->result) - $expected1);
        $newRating2 = $rating2 + $K * ($this->getScoreWithResult($score2->result) - $expected2);

        return array($newRating1, $newRating2);
    }

    function valeur_k($elo): ?int
    {
        $k = null;

        if ($elo < 1000) {
            $k = 80;
        }

        if ($elo >= 1000 and $elo < 2000) {
            $k = 50;
        }

        if ($elo >= 2000 and $elo <= 2400) {
            $k = 30;
        }

        if ($elo > 2400) {
            $k = 20;
        }

        return $k;
    }

    public function getScoreWithResult($result)
    {
        return match ($result::$name) {
//            GameResultEnum::win->value => 1.2,
//            GameResultEnum::pat->value => 0.85,
//            GameResultEnum::nul->value => 0.5,
//            GameResultEnum::lose->value => 0,
            Win::$name => 1.2,
            Pat::$name => 0.85,
            Draw::$name => 0.5,
            Loss::$name => 0,
            Pending::$name => 0,
        };
    }

    public function decline()
    {
        dd("perdu");
    }

    public function refreshListPlayer()
    {
        $this->gamePlayer = $this->game->gamePlayers;
    }

    public function acceptInvitation()
    {
        try {
            $allCompleted = true;

            foreach ($this->gamePlayer as $player) {
                if ($player->user_id === Auth::id()) {
                    $player->player_participation_validation->transitionTo(\App\ModelStates\PlayerParticipationStates\Accepted::class);
                    $player->save();

                    User::find($player->user_id)->notify(new GameAcceptedSendedNotification($this->game));
                } else {
                    $opponent = $player;
                }

                if ($player->player_participation_validation->equals(Pending::class)) {
                    $allCompleted = false;
                }
            }

            if ($allCompleted) {
                $this->game->status->transitionTo(GameAccepted::class);
                $this->game->save();

                if (isset($opponent)) {
                    $user = User::find($opponent->user_id);
                    $user->notify(new GameAcceptedNotification($this->game));
                }
            }

            $this->successToast('You accepted the game');
            $allCompleted = true;

            foreach ($this->gamePlayer as $player) {
                if ($player->user_id === Auth::id()) {
                    $player->player_participation_validation->transitionTo(\App\ModelStates\PlayerParticipationStates\Accepted::class);
                    $player->save();
                }

                if ($player->player_participation_validation->equals(Pending::class)) {
                    $allCompleted = false;
                }
            }

            if ($allCompleted) {
                $this->game->status->transitionTo(GameAccepted::class);
                $this->game->save();
            }

            $this->successToast('You accepted the game');
            $this->winner = $this->game->gamePlayers->toQuery()->where('result', '=', 'win')->first();
            $this->CurrentUserGame = $this->gamePlayer->where('user_id', '=', Auth::id())->first();
        } catch (Exception $e) {
            report($e);
        }
        $this->emitSelf('refreshListPlayer');
        return view('livewire.chess.game.result-form-chess');
    }

    public function LaunchGame()
    {
        try {
            $this->game->status->transitionTo(InProgress::class);
            foreach ($this->gamePlayer as $player) {
                User::find($player->user_id)->notify(new GameLaunchedNotification($this->game));
            }

            $this->successToast('Game is now launch dont forget close bet');
        } catch (Exception $e) {
            report($e);
        }
        $this->emitSelf('refreshListPlayer');

    }

    public function refuseInvitation()
    {
        try {
            foreach ($this->gamePlayer as $player) {
                if ($player->user_id !== Auth::id()) {
                    $opponent = $player;
                }
            }

            if (isset($opponent)) {
                $user = User::find($opponent->user_id);
                $user->notify(new GameDeclinedNotification($this->game));
            }

            $this->gamePlayer->transitionTo(\App\ModelStates\PlayerParticipationStates\Declined::class);

            $this->emitSelf('refreshListPlayer');

        } catch (Exception $e) {
            report($e);
        }
    }

    public function render()
    {
        return view('livewire.chess.game.show-chess');
    }
}

<?php

namespace App\Http\Livewire\Darts\Game;

use App\Enums\GameResultEnum;
use App\Http\Livewire\Darts\Game\Traits\HasGameResultMapperDarts;
use App\Http\Livewire\Traits\HasToast;
use App\Models\Bet;
use App\Models\Game;
use App\Models\GamePlayer;
use App\Models\User;
use App\ModelStates\BetStates\LooseBet;
use App\ModelStates\BetStates\WinBet;
use App\ModelStates\GameStates\GameAccepted;
use App\ModelStates\GameStates\InProgress;
use App\ModelStates\GameStates\PlayersValidation;
use App\ModelStates\GameStates\Validate;
use App\ModelStates\PlayerParticipationStates\Pending;
use App\ModelStates\PlayerRecognitionResultStates\Accepted;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ShowDarts extends Component
{

    use HasGameResultMapperDarts, HasToast;

    public Game $game;

    public bool $isBetAvailable = false;
    public ?GamePlayer $winner;
    public Collection $gamePlayer;

    public ?GamePlayer $currentUserGame = null;

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
    }

    public function accept()
    {
        try {
            $gameBets = Bet::query()->with('user')->where('game_id', $this->game->id)->get();

            $users = $this->game->gamePlayers;

            $winner = null;
            $looser = null;

            foreach ($users as $player) {
                if ($player->result->value === 'win') {
                    $winner = $player;
                    continue;
                }

                $looser = $player;
            }

            $eloJ1 = Elo::query()->where('user_id', Arr::get($users, 0)->user->id)->where('sport_id', 2)->first()->elo;
            $eloJ2 = Elo::query()->where('user_id', Arr::get($users, 1)->user->id)->where('sport_id', 2)->first()->elo;

            $result = $this->newRatings($eloJ1, $eloJ2, Arr::get($users, 0), Arr::get($users, 1));

            Elo::query()->where('user_id', Arr::get($users, 0)->user->id)->where('sport_id', 2)->first()->update(['elo' => $result[0]]);
            Elo::query()->where('user_id', Arr::get($users, 1)->user->id)->where('sport_id', 2)->first()->update(['elo' => $result[1]]);

            $allCompleted = true;
            foreach ($this->gamePlayer as $player) {
                if ($player->user_id === Auth::id()) {
                    $player->player_result_validation->transitionTo(Accepted::class);
                    $player->save();
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
                }

            }

            $this->dispatchBrowserEvent('toast', ['message' => __("You approved the result !"), 'type' => 'success']);

            redirect()->route('darts.dashboard');
        } catch (Exception $e) {
            report($e);
            $this->errorToast('quelque chose c\'est mal passé');
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
        return match ($result) {
//            GameResultEnum::win->value => 1.2,
//            GameResultEnum::pat->value => 0.85,
//            GameResultEnum::nul->value => 0.5,
//            GameResultEnum::lose->value => 0,
            Win::$name => 1.2,
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
        return view('livewire.darts.game.result-form');
    }

    public function LaunchGame()
    {
        try {
            $this->game->status->transitionTo(InProgress::class);

            $this->successToast('Game is now launch dont forget close bet');
        } catch (Exception $e) {
            report($e);
        }
        $this->emitSelf('refreshListPlayer');

    }

    public function refuseInvitation()
    {
        try {

            $this->CurrentUserGame->player_participation_validation->transitionTo(\App\ModelStates\PlayerParticipationStates\Declined::class);
            $this->emitSelf('refreshListPlayer');
        } catch (Exception $e) {
            report($e);
        }
    }

    public function render()
    {
        return view('livewire.darts.game.show-darts');
    }
}

<?php

namespace App\Http\Livewire\Game;

use App\Models\Game;
use App\Models\User;
use App\ModelStates\GameStates\InProgress;
use App\ModelStates\PlayerParticipationStates\Pending;
use Livewire\Component;
use App\Models\GamePlayer;
use Illuminate\Support\Arr;
use App\Enums\GameResultEnum;
use Illuminate\Support\Facades\Auth;
use \App\Models\Bet;
use App\Http\Livewire\Traits\HasToast;
use App\ModelStates\GameStates\Validate;
use App\ModelStates\GameStates\GameAccepted;
use Illuminate\Database\Eloquent\Collection;
use App\ModelStates\PlayerResultStates\Accepted;
use App\Http\Livewire\Game\Traits\HasGameResultMapper;
use PhpOffice\PhpSpreadsheet\Calculation\Statistical\Averages;

class Show extends Component
{

    use HasGameResultMapper, HasToast;

    public Game $game;

    public bool $isBetAvailable = false;
    public ?GamePlayer $winner;
    public Collection $gamePlayer;

    public ?GamePlayer $currentUserGame = null;

    protected $listeners = ['refreshComponent' => '$refresh', 'refreshListPlayer'];

    public function mount($game)
    {
        $this->game = $game;
        $this->gamePlayer = $game->gamePlayers;
        $this->winner = $game->gamePlayers->toQuery()->where('result', '=', 'win')->first();
        if($this->gamePlayer->where('user_id' ,'=', Auth::id())->first()){
            $this->currentUserGame = $this->gamePlayer->where('user_id' ,'=', Auth::id())->first();
        }
        $this->isBetAvailable = $game->bet_available
            && empty(Bet::query()->where('game_id', $game->id)->where('gambler_id', Auth::id())->first())
            && in_array($game->status, ['playersvalidation', 'accepted']);
    }

    public function accept()
    {
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

        $eloJ1 = Arr::get($users, 0)->user->elo;
        $eloJ2 = Arr::get($users, 1)->user->elo;

        $result = $this->newRatings($eloJ1, $eloJ2, Arr::get($users, 0), Arr::get($users, 1));
//
        Arr::get($users, 0)->user->elo = $result[0];
        Arr::get($users, 0)->user->save();
        Arr::get($users, 1)->user->elo = $result[1];
        Arr::get($users, 1)->user->save();

        $allCompleted = true;
        foreach ($this->gamePlayer as $player) {
            if ($player->user_id === Auth::id()) {
                $player->player_result_validation->transitionTo(Accepted::class);
                $player->save();
            }
            if ($player->player_result_validation == "pending") {
                $allCompleted = false;
            }
        }
        if ($allCompleted) {
            $this->game->status->transitionTo(Validate::class);
            if ($this->game->save()) {
                collect($gameBets)
                    ->map(function ($gameBet) {
                        return User::query()->where('id', $gameBet->user->id)->increment('coins', $gameBet->bet_gain);
                    });
            }

        }

        $this->dispatchBrowserEvent('toast', ['message' => __("You approved the result !"), 'type' => 'success']);

        redirect()->route('dashboard');
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


        $newRating1 = $rating1 + $K * ($this->getScoreWithResult($score1->result->value) - $expected1);
        $newRating2 = $rating2 + $K * ($this->getScoreWithResult($score2->result->value) - $expected2);

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
            GameResultEnum::win->value => 1.2,
            GameResultEnum::pat->value => 0.85,
            GameResultEnum::nul->value => 0.5,
            GameResultEnum::lose->value => 0,
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
        $allCompleted = true;
        foreach ($this->gamePlayer as $player) {
            if ($player->user_id === Auth::id()) {
                $player->player_participation_validation->transitionTo(\App\ModelStates\PlayerParticipationStates\Accepted::class);
                $player->save();
            }
            if ($player->player_participation_validation === Pending::$name) {
                $allCompleted = false;
            }
        }
        if ($allCompleted) {
            $this->game->status->transitionTo(GameAccepted::class);
            $this->game->save();
        }


        $this->winner = $this->game->gamePlayers->toQuery()->where('result', '=', 'win')->first();
        $this->CurrentUserGame = $this->gamePlayer->where('user_id', '=', Auth::id())->first();

        $this->successToast('You accepted the game');
        $this->emitSelf('refreshListPlayer');
        return view('livewire.game.result-form');
    }

    public function LaunchGame()
    {
        $this->game->status->transitionTo(InProgress::class);

        $this->successToast('Game is now launch dont forget close bet');
        $this->emitSelf('refreshListPlayer');
    }

    public function refuseInvitation()
    {
        $this->CurrentUserGame->player_participation_validation->transitionTo(\App\ModelStates\PlayerParticipationStates\Declined::class);
        $this->emitSelf('refreshListPlayer');
    }

    public function render()
    {
        return view('livewire.game.show');
    }
}

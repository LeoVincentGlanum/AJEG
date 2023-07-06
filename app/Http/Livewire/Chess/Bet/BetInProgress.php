<?php

namespace App\Http\Livewire\Chess\Bet;

use App\Models\Bet;
use App\Models\Game;
use Livewire\Component;

class BetInProgress extends Component
{
    public $bets_in_progress;

    public function mount()
    {
        $this->bets_in_progress =  Game::query()
            ->with(['bets', 'gamePlayers', 'gamePlayers.user', 'gamePlayers.user.elos' => function($query){
                $query->where('sport_id', '=', 1);
            }])
            ->where('status', '=', 'gameaccepted')
            ->where('bet_available','1')
            ->orderByDesc('updated_at')
            ->limit(4)
            ->get();
    }

    public function betsPerGame($id_game): \Illuminate\Database\Eloquent\Collection|array
    {
        $betsPerGame = Bet::query()
            ->where('game_id', $id_game)
            ->get();

        return $betsPerGame;
    }

    public function totalCoinsBet($id_game)
    {
        $totalCoinsBet = 0;

        $betsPerGame = $this->betsPerGame($id_game);

        foreach ($betsPerGame as $betPerGame) {
            $totalCoinsBet += $betPerGame->bet_deposit;
        }

        return $totalCoinsBet;
    }

    public function render()
    {
        return view('livewire.chess.bet.bet-in-progress');
    }
}

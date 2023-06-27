<?php

namespace App\Http\Livewire\Chess\Bet;

use App\Models\Bet;
use App\Models\Game;
use Livewire\Component;

class BetChess extends Component
{
    public int $countGameInProgress;

    public function mount(){
        $this->countGameInProgress =Game::query()
                                    ->with(['bets', 'gamePlayers', 'gamePlayers.user', 'gamePlayers.user.elos' => function($query){
                                        $query->where('sport_id', '=', 1);
                                    }])
                                    ->where('status', '=', 'inprogress')
                                    ->where('bet_available','1')
                                    ->orderByDesc('updated_at')
                                    ->count();
    }

    public function render()
    {
        return view('livewire.chess.bet.bet-chess');
    }
}

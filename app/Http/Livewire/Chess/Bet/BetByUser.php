<?php

namespace App\Http\Livewire\Chess\Bet;

use App\Models\Bet;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class BetByUser extends Component
{
    public $bets_in_progress;
    public int $count = 0;

    public function mount()
    {
       $this->bets_in_progress = Bet::query()
           ->with(['game', 'game.gamePlayers', 'game.gamePlayers.user'])
           ->where('gambler_id', '=', Auth::id())
           ->where('bet_status', '=', 'Pending')
           ->orderByDesc('updated_at')
           ->limit(2)
           ->get();
    }

    public function render()
    {
        return view('livewire.chess.bet.bet-by-user');
    }
}

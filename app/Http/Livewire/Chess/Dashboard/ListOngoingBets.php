<?php

namespace App\Http\Livewire\Chess\Dashboard;

use App\Models\Bet;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ListOngoingBets extends Component
{
    public function getBetsProperty(): Collection|array
    {
        return Bet::query()
            ->with(['game', 'game.gamePlayers', 'game.gamePlayers.user'])
            ->where('gambler_id', '=', Auth::id())
            ->where('bet_status', '=', 'Pending')
            ->orderByDesc('updated_at')
            ->limit(2)
            ->get();
    }

    public function render()
    {
        return view('livewire.chess.dashboard.list-ongoing-bets');
    }
}

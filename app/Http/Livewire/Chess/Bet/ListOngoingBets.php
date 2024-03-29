<?php

namespace App\Http\Livewire\Chess\Bet;

use App\Models\Bet;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ListOngoingBets extends Component
{
    protected $listeners = ['refreshList' => '$refresh'];

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

    public function getBetsCountProperty(): int
    {
        return Bet::query()
            ->where('gambler_id', '=', Auth::id())
            ->where('bet_status', '=', 'Pending')
            ->count();
    }

    public function render()
    {
        return view('livewire.chess.bet.list-ongoing-bets');
    }
}

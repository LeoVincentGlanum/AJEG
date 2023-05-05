<?php

namespace App\Http\Livewire\Chess\Game;

use App\Models\Game;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ListHistory extends Component
{
    public function getGamesProperty()
    {
        return Game::query()
            ->with(['gamePlayers', 'gamePlayers.user'])
            ->where('status', '=', 'validate')
            ->whereRelation('gamePlayers', 'user_id', '=', Auth::id())
            ->get();
    }

    public function render()
    {
        return view('livewire.chess.game.list-history');
    }
}

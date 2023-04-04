<?php

namespace App\Http\Livewire\Chess\Dashboard;

use App\Models\Game;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class ListOngoingGames extends Component
{
    public function getGamesProperty(): Collection|array
    {
        return Game::query()
            ->with(['bets', 'gamePlayers', 'gamePlayers.user', 'gamePlayers.user.elos' => function($query){
                $query->where('sport_id', '=', 1);
            }])
            ->where('status', '=', 'inprogress')
            ->orderByDesc('updated_at')
            ->limit(4)
            ->get();
    }

    public function render()
    {
        return view('livewire.chess.dashboard.list-ongoing-games');
    }
}

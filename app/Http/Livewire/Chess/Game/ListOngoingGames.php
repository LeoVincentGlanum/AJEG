<?php

namespace App\Http\Livewire\Chess\Game;

use App\Models\Game;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class ListOngoingGames extends Component
{
    protected $listeners = ['refreshList' => '$refresh'];

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

    public function getGamesCountProperty(): int
    {
        return Game::query()
            ->where('status', '=', 'inprogress')
            ->count();
    }

    public function render()
    {
        return view('livewire.chess.game.list-ongoing-games');
    }
}

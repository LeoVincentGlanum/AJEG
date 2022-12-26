<?php

namespace App\Http\Livewire\Game;

use App\Models\Game;
use Livewire\Component;
use Illuminate\Database\Eloquent\Collection;

class Show extends Component
{
    public Game $game;

    public Collection $gamePlayer;

    public function mount($game)
    {
        $this->game = $game;
        $this->gamePlayer = $game->gamePlayers;
    }

    public function render()
    {
        return view('livewire.game.show');
    }
}

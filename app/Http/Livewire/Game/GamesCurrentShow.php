<?php

namespace App\Http\Livewire\Game;

use Livewire\Component;

class GamesCurrentShow extends Component
{


    public function mount($games){
        $this->games = $games;
    }


    public function render()
    {
        return view('livewire.game.games-current-show');
    }
}

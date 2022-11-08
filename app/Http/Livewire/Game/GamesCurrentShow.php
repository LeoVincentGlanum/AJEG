<?php

namespace App\Http\Livewire\Game;

use App\Models\Game;
use http\QueryString;
use Livewire\Component;
use MongoDB\Driver\Query;

class GamesCurrentShow extends Component
{
    public function mount($games){
        $this->games = $games;
    }

    public function getGames(){
        $games = Game::query()->get();
        return $games;
    }

    public function render()
    {
        return view('livewire.game.games-current-show', [
            'games' => $this->getGames()
        ]);
    }
}

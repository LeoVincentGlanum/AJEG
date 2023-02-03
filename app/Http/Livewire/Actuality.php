<?php

namespace App\Http\Livewire;

use App\Models\Bet;
use App\Models\Game;
use App\ModelStates\GameStates\GameAccepted;
use App\ModelStates\GameStates\PlayersValidation;
use Livewire\Component;

class Actuality extends Component
{
    public function mount()
    {
        $this->bets = Game::query()->with("gamePlayers.user")->whereIn("status", [PlayersValidation::$name, GameAccepted::$name])->get();

    }
    public function render()
    {
        return view('livewire.actuality',[
            "bets" => $this->bets,
        ]);
    }
}

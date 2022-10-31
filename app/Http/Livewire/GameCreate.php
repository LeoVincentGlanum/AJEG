<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use App\Models\GameType;

class GameCreate extends Component
{

    public $users;
    public $type;
    public $gameTypes;
    public $players = [];
    public $partyName;

    public function mount(){
        $this->users = User::all();
        $this->gameTypes = GameType::all();
    }

    public function render()
    {
        return view('livewire.game-create');
    }


    public function gotto(){
        return redirect("dashboard");
    }

    public function submit(){
        $arrayPlayer = $this->users;


    }
}

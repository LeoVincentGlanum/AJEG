<?php

namespace App\Http\Livewire;

use App\Models\User;
use App\Models\Game;
use Livewire\Component;
use App\Models\GameType;
use App\Models\GamePlayer;

class GameCreate extends Component
{

    public $users;
    public $type = "ask";
    public $gameTypes;

    public $players = [];

    public $partyName;

    public function mount(){
        $this->users = User::all();
        $this->gameTypes = GameType::all();
    }


    public function gotto(){
        return redirect("dashboard");
    }

    public function submit(){
        $arrayPlayer = $this->users;

        $newGame = new Game();
        $newGame->status = $this->type;
        $newGame->save();

        foreach ($arrayPlayer as $player){
            $gameplay = new GamePlayer();
            $gameplay->game_id = $newGame->id;


        }

    }

       public function render()
    {
        return view('livewire.game-create');
    }


}

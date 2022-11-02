<?php

namespace App\Http\Livewire;

use App\Models\User;
use App\Models\Game;
use Livewire\Component;
use App\Models\GameType;
use App\Models\GamePlayer;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class GameCreate extends Component
{

    public $users;
    public $type = "ask";
    public $gameTypes;
    public $resultat;
    public $players = [];
    public $selectBlanc = "nul";
    public $playersColors = [];

    public $partyName;

    protected $messages = [
        'selectBlanc.not_in' => 'Attention ! Merci de selectionner un joueur blanc',
    ];

    public function mount()
    {
        $this->users     = User::all();
        $this->gameTypes = GameType::all();
    }


    public function gotto()
    {
        return redirect("dashboard");
    }

    public function updatedPlayers($value)
    {
         foreach ($this->playersColors as $key => $color) {
            if (!in_array($key,$this->players)){
                unset($this->playersColors[$key]);
            }
        }
    }

    public function rules()
    {
        if (count($this->players) > 2) {
            return [
                'selectBlanc' => 'sometimes',
                'playersColors' => 'required|array|size:'. count($this->players),
                'playersColors.*' => 'required|string'
            ];
        }

        return [
             'selectBlanc' => 'required|not_in:nul',
        ];
    }

    public function submit()
    {
        $this->validate();

        $newGame = new Game();
        $newGame->label = $this->partyName;
        $newGame->status = $this->type;
        $newGame->save();

        foreach ($this->players as $player) {

            if (count($this->playersColors) > 0 ){
                $color = $this->playersColors[$player];
            }
            if($this->selectBlanc === $player) {
                $color = "blanc";
            }
            $color = "noir";


            if($this->resultat == "nul" || $this->resultat == "path" ){
                $result = $this->resultat;
            }


            $gameplayer          = new GamePlayer();
            $gameplayer->game_id = $newGame->id;
            $gameplayer->user_id = $player->id;
            $gameplayer->color   = $color;
            $gameplayer->result  = "";
        }
    }

    public function render()
    {
        return view('livewire.game-create');
    }


}

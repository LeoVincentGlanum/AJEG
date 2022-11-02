<?php

namespace App\Http\Livewire;

use App\Models\User;
use App\Models\Game;
use Livewire\Component;
use App\Models\GameType;
use App\Models\GamePlayer;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Collection;

class GameCreate extends Component
{

    public Collection $users;
    public string $type = "ask";
    public ?Collection $gameTypes;
    public ?string $resultat = "";
    public ?array $players = [];
    public ?string $selectBlanc = "nul";
    public ?array $playersColors = [];
    public ?string $partyName = "";

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
        if (count($this->players) > 0){
            foreach ($this->playersColors as $key => $color) {
            if (!in_array($key,$this->players)){
                unset($this->playersColors[$key]);
            }
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
            $color = "noir";
            if (count($this->playersColors) > 0 ){
                $color = $this->playersColors[$player];
            }
            if($this->selectBlanc == $player) {
                $color = "blanc";
            }

            $result = "loose";

            if($this->resultat == "nul" || $this->resultat == "path" ){
                $result = $this->resultat;
            }

            if ($this->resultat == $player){
                $result = "win";
            }
              //dd($this->resultat,$this->selectBlanc,$player);



            $gameplayer          = new GamePlayer();
            $gameplayer->game_id = $newGame->id;
            $gameplayer->user_id = $player;
            $gameplayer->color   = $color;
            $gameplayer->result  = $result;
            $gameplayer->save();

            session()->flash('message', 'Post successfully updated.');
             return redirect('dashboard');
        }
    }

    public function render()
    {
        return view('livewire.game-create');
    }


}

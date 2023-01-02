<?php

namespace App\Http\Livewire\Game;

use App\Models\Game;
use Livewire\Component;
use App\Models\GamePlayer;
use Illuminate\Support\Facades\Auth;
use App\ModelStates\GameStates\Validate;
use Illuminate\Database\Eloquent\Collection;
use App\ModelStates\PlayerResultStates\Accepted;

class Show extends Component
{
    public Game $game;
    public ?GamePlayer $winner;
    public Collection $gamePlayer;

    public function mount($game)
    {
        $this->game = $game;
        $this->gamePlayer = $game->gamePlayers;
        $this->winner = $game->gamePlayers->toQuery()->where('result','=','win')->first();

    }

    public function accept(){
        $allCompleted = true;
        foreach ($this->gamePlayer as $player){
            if ($player->user_id === Auth::id()){
                $player->player_result_validation->transitionTo(Accepted::class);
                $player->save();
            }
            if ($player->player_result_validation == "pending"){
                $allCompleted = false;
            }
        }
        if($allCompleted){
            $this->game->status->transitionTo(Validate::class);
            $this->game->save();
        }
    }

    public function decline(){
        dd("perdu");

    }

    public function render()
    {
        return view('livewire.game.show');
    }
}

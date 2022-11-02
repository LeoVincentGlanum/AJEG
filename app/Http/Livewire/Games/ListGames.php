<?php

namespace App\Http\Livewire\Games;

use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;
use App\Models\Game;

class ListGames extends Component
{
    public Collection $games;

    public function mount(){
        $this->games = Game::query()->with(['users'])->get();
    }

    public function render()
    {
        return view('livewire.games.list-games');
    }

    public function gameResult($game)
    {


        foreach ($game->users as $player) {
            if ($player->pivot->result === 'win')
            {
                return $player->name." a gagné";

            } elseif ($player->pivot->result === 'null')
            {
                return "Match null";

            } elseif ($player->pivot->result === 'path')
            {
                return "Path";
            }
        }

        return "-";
    }
}

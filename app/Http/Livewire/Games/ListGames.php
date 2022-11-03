<?php

namespace App\Http\Livewire\Games;

use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;
use App\Models\Game;
use Livewire\WithPagination;

class ListGames extends Component
{
    public Collection $games;
    use WithPagination;

    public function mount(){
//        $this->games = Game::query()->with(['users'])->get();
    }

    public $search = '';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        return view('livewire.games.list-games', [
            'pageGames' => Game::query()->with(['users'])->where('status', 'like', '%'.$this->search.'%')->paginate(5),
        ]);
    }

    public function paginationView()
    {
        return 'component.pagination';
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

<?php

namespace App\Http\Livewire\Games;

use App\Models\GamePlayer;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Log;
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

    public $searchStatus = '';
    public $searchPlayer = '';
    public $searchResult = '';

    public function updateSearch()
    {
        $this->searchStatus = '';
        $this->searchPlayer = '';
        $this->searchResult = '';

        $this->goToPage(1);
    }

    public function render()
    {
        $game = Game::query()->with(['users','gamePlayers'])
            ->where('status', 'like', '%'.$this->searchStatus.'%');

        return view('livewire.games.list-games', [
            'Player' => $this->searchPlayer,
            'Status' => $this->searchStatus,
            'Result' => $this->searchResult,
            'pageGames' => $game

                ->when(($this->searchPlayer !== '' && $this->searchResult !== ''), function ($query) {
                     $query->whereHas('users',fn($query)=>$query->where('users.name','like','%'.$this->searchPlayer.'%')
                                                                    ->where('game_players.result','like','%'.$this->searchResult.'%'));
                })
                ->when(($this->searchPlayer !== '' && $this->searchResult === ''), function ($query, $role) {
                    $query->whereRelation('users', 'name', 'like', '%'.$this->searchPlayer.'%');
                })
                ->when(($this->searchPlayer === '' && $this->searchResult !== ''), function ($query, $role) {
                    $query->whereRelation('users', 'result', 'like', '%'.$this->searchResult.'%');
                })
                ->paginate(5),
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

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
    public $searchResultPlayer = '';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $game = Game::query()->with(['users','gamePlayers'])
            ->where('status', 'like', '%'.$this->searchStatus.'%');
//            ->whereHas('users', function ($query) {
//        $query->where('name', 'like','%'.$this->searchPlayer.'%');
//    })
//            ->whereHas('gamePlayers', function ($query) {
//                $query->where('result', '=',$this->searchResult);
//            })->get();

        return view('livewire.games.list-games', [
            'pageGames' => $game

                ->when(($this->searchPlayer !== '' && $this->searchResult !== ''), function ($query, $role) {
//                    $user_id = $query->whereRelation('users', 'name', 'like', '%'.$this->searchPlayer.'%');
//                    Log::info($user_id );
                    return $query->whereRelation('users', 'name', 'like', '%'.$this->searchPlayer.'%')
                          ->whereRelation('users', 'result', 'like', '%'.$this->searchResult.'%');
                })
//
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

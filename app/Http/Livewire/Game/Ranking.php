<?php
//
//namespace App\Http\Livewire\Game;
//
//use App\Models\User;
//use Illuminate\Pagination\LengthAwarePaginator;
//use Illuminate\Support\Collection;
//use Livewire\Component;
//use Livewire\WithPagination;
//
//class Ranking extends Component
//{
//    use WithPagination;
//
//    public string $searchPlayer = '';
//    public LengthAwarePaginator $users;
//    public array $rank;
//    protected $queryString = [
//        'searchPlayer' => ['except' => '']
//    ];
//
//    public function paginationView(): string
//    {
//        return 'component.pagination-ranking';
//    }
//
//    public function mount()
//    {
//        $this->users = User::where('name', 'LIKE', "%{$this->searchPlayer}%")->orderBy('elo', 'desc')->paginate(20);
//        $usersToRank = User::query()->orderBy('elo', 'desc')->get();
//
//        $cpt = 1;
//        foreach ($usersToRank as $user) {
//            $this->rank[$user->id] = $cpt;
//            $cpt++;
//        }
//    }
//
//    public function render()
//    {
//        return view('livewire.game.ranking', ['users' => $this->users, 'page' => $this->page, 'user_rank' => $this->rank]);
//    }
//}

namespace App\Http\Livewire\Game;

use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;
use Livewire\Component;
use Livewire\WithPagination;

class Ranking extends Component
{
    use WithPagination;

    public string $searchPlayer = '';
    protected $queryString = [
        'searchPlayer' => ['except' => '']
    ];

    public function paginationView()
    {
        return 'component.pagination-ranking';
    }

    public function render()
    {
        $usersToRank = User::query()->orderBy('elo', 'desc')->get();

        $rank = [];

        $cpt = 1;
        foreach ($usersToRank as $user) {
            $rank[$user->id] = $cpt;
            $cpt++;
        }

        return view('livewire.game.ranking', ['users' => User::where('name', 'LIKE', "%{$this->searchPlayer}%")->orderBy('elo', 'desc')->paginate(20), 'page' => $this->page, 'user_rank' => $rank]);
    }
}
<?php

namespace App\Http\Livewire\Game;

use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;
use Livewire\Component;
use Livewire\WithPagination;


class Ranking1 extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public string $searchPlayer = '';
    public $page = 1;
    public LengthAwarePaginator $userPaginate;

    public function gotoPage($page)
    {
        return $page;
    }

    public function makeQueryFilter(): LengthAwarePaginator
    {
        return User::query()
            ->where('name', 'like', '%' . $this->searchPlayer . '%')
            ->orderBy('elo', 'desc')
            ->paginate(30);
    }

    public function paginationView(): string
    {
        return 'component.pagination-ranking';
    }

    public function render()
    {
        if ($this->searchPlayer === '') {
            $users = User::query()->orderBy('elo', 'desc')->paginate(30);
        }else{
            $users = $this->makeQueryFilter();
        }

        $usersToRank = User::query()->orderBy('elo', 'desc')->get();

        $rank = [];

        $cpt = 1;
        foreach ($usersToRank as $user) {
            $rank[$user->id] = $cpt;
            $cpt++;
        }

        return view('livewire.game.ranking', ['users' => $users, 'user_rank' => $rank, 'page' => $this->page]);
    }
}

<?php

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

    public function paginationView(): string
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

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
    public array $rank;

    public array $EloRanks =
        [
            'Grand Master'=> ['King-Transparent-PNG.png',2500,0],
            'Master'=> ['grandmaster.png',2000,1750],
            'Diamant'=> ['diams.png',1750,1500],
            'Rubis'=> ['rubis.png',1500,1200],
            'Gold'=> ['gold.png',1200,800],
            'Silver'=> ['silver.jfif',499,800],
            'Charbon'=> ['charbon.jfif',0,499],

        ];
    public function mount()
    {
        $usersToRank = User::query()->orderBy('elo', 'desc')->get();

        $this->rank = [];

        $cpt = 1;
        foreach ($usersToRank as $user) {
            $this->rank[$user->id] = $cpt;
            $cpt++;
        }
    }

    public function makeQueryFilter(): LengthAwarePaginator
    {
        if ($this->searchPlayer !== '') {
            $this->goToPage(1);

            return User::query()
                ->where('name', 'like', '%' . $this->searchPlayer . '%')
                ->orderBy('elo', 'desc')
                ->paginate(20);
        }

        return User::query()->orderBy('elo', 'desc')->paginate(20);
    }

    public function render()
    {
        return view('livewire.game.ranking', [
            'users' => $this->makeQueryFilter(),
            'user_rank' => $this->rank,
        ]);

    }
}

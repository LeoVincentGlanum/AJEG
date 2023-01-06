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
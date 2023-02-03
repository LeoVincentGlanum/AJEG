<?php

namespace App\Http\Livewire\Chess\Game;

use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;
use Livewire\Component;
use Livewire\WithPagination;

class RankingChess extends Component
{
    use WithPagination;

    public string $searchPlayer = '';
    public array $rank;
    public array $elo_chess;

    public array $EloRanks =
        [
            'Grand Master' => ['King-Transparent-PNG.png', 2000, 4000],
            'Master' => ['grandmaster.png', 1750, 2000],
            'Diamant' => ['diams.png', 1500, 1750],
            'Rubis' => ['rubis.png', 1200, 1500],
            'Gold' => ['gold.png', 800, 1200],
            'Silver' => ['silver.jfif', 499, 800],
            'Charbon' => ['charbon.jfif', 0, 499],

        ];

    public function mount()
    {
        $usersToRank = User::query()->join('ajeg_elo', function ($join) {
            $join->on('ajeg_users.id', '=', 'ajeg_elo.user_id')->where('ajeg_elo.sport_id', 1);
        })->orderBy('ajeg_elo.elo', 'desc')->get();

        $this->rank = [];

        $cpt = 1;
        foreach ($usersToRank as $user) {
            $this->rank[$user->id] = $cpt;
            $cpt++;
            $this->elo_chess[$user->id] = $user->elo;
        }


    }

    public function makeQueryFilter(): LengthAwarePaginator
    {
        if ($this->searchPlayer !== '') {
            $this->goToPage(1);

            return User::query()
                ->where('name', 'like', '%' . $this->searchPlayer . '%')
                ->join('ajeg_elo', function ($join) {
                    $join->on('ajeg_users.id', '=', 'ajeg_elo.user_id')->where('ajeg_elo.sport_id', 1);
                })
                ->orderBy('ajeg_elo.elo', 'desc')
                ->paginate(20);
        }

        return User::query()->join('ajeg_elo', function ($join) {
            $join->on('ajeg_users.id', '=', 'ajeg_elo.user_id')->where('ajeg_elo.sport_id', 1);
        })
            ->orderBy('ajeg_elo.elo', 'desc')->paginate(20);
    }

    public function render()
    {
        return view('livewire.chess.game.ranking-chess', [
            'users' => $this->makeQueryFilter(),
            'user_rank' => $this->rank,
            'elo_chess' => $this->elo_chess,
        ]);

    }
}

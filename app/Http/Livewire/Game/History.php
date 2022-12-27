<?php

namespace App\Http\Livewire\Game;

use App\Enums\GameResultEnum;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;
use App\Models\Game;
use Livewire\WithPagination;

class History extends Component
{
    use WithPagination;

    public Collection $games;

    public string $searchStatus = '';

    public string $searchPlayer = '';

    public string $searchResult = '';

    public function makeQueryFilter(): LengthAwarePaginator
    {
        return Game::query()
            ->with(['users', 'gamePlayers'])
            ->where('status', 'like', '%'.$this->searchStatus.'%')
            ->when(($this->searchPlayer !== '' && $this->searchResult !== ''), function ($query) {
                $query->whereHas('users', fn($query) => $query->where('users.name', 'like', '%'.$this->searchPlayer.'%')
                    ->where('game_players.result', 'like', '%'.$this->searchResult.'%'));
            })
            ->when(($this->searchPlayer !== '' && $this->searchResult === ''), function ($query) {
                $query->whereRelation('users', 'name', 'like', '%'.$this->searchPlayer.'%');
            })
            ->when(($this->searchPlayer === '' && $this->searchResult !== ''), function ($query) {
                $query->whereRelation('users', 'result', 'like', '%'.$this->searchResult.'%');
            })
            ->paginate(10);
    }

    public function resetFilters()
    {
        $this->searchStatus = '';
        $this->searchPlayer = '';
        $this->searchResult = '';

        $this->goToPage(1);
    }

    public function gameResult($game): string
    {
        foreach ($game->users as $player) {
            if ($player->pivot->result === GameResultEnum::lose->value) {
                continue;
            }

            return match ($player->pivot->result) {
                GameResultEnum::win->value => $player->name." a gagné",
                GameResultEnum::nul->value => "Match nul",
                GameResultEnum::pat->value => "Pat",
            };
        }

        return "-";
    }

    public function paginationView(): string
    {
        return 'component.pagination';
    }

    public function render()
    {
        return view('livewire.game.history', [
            'pageGames' => $this->makeQueryFilter(),
        ]);
    }
}

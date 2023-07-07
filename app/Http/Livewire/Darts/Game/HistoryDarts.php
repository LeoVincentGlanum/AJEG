<?php

namespace App\Http\Livewire\Darts\Game;

use App\Enums\GameResultEnum;
use App\Models\Game;
use App\ModelStates\GameStates\ResultValidations;
use App\ModelStates\GameStates\Validate;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;
use Livewire\WithPagination;

class HistoryDarts extends Component
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
            ->where('status', 'like', '%' . $this->searchStatus . '%')
            ->when(($this->searchPlayer !== '' && $this->searchResult !== ''), function ($query) {
                $query->whereHas('users', fn($query) => $query->where('users.name', 'like', '%' . $this->searchPlayer . '%')
                    ->where('game_players.result', 'like', '%' . $this->searchResult . '%'));
            })
            ->when(($this->searchPlayer !== '' && $this->searchResult === ''), function ($query) {
                $query->whereRelation('users', 'name', 'like', '%' . $this->searchPlayer . '%');
            })
            ->when(($this->searchPlayer === '' && $this->searchResult !== ''), function ($query) {
                $query->whereRelation('users', 'result', 'like', '%' . $this->searchResult . '%');
            })
            ->where("sport_id", 2)
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
        if ($game->status == Validate::$name) {
            foreach ($game->gamePlayers as $player) {
                if ($player->result !== null) {
                    if ($player->result->value === GameResultEnum::lose->value) {
                        continue;
                    }
                    return match ($player->result->value) {
                        GameResultEnum::win->value => $player->user->name . " a gagné",
                        GameResultEnum::nul->value => "Match nul",
                        GameResultEnum::pat->value => "Pat",
                    };
                }
            }
            return "-";
        } elseif ($game->status == ResultValidations::$name) {
            foreach ($game->gamePlayers as $player) {
                if ($player->result !== null) {
                    if ($player->result->value === GameResultEnum::lose->value) {
                        continue;
                    }
                    return match ($player->result->value) {
                        GameResultEnum::win->value => "[En attente] " . $player->user->name . " a gagné",
                        GameResultEnum::nul->value => "[En attente] Match nul",
                        GameResultEnum::pat->value => "[En attente] Pat",
                    };
                }
            }

            return "-";
        } else {
            return "-";
        }


    }

    public function paginationView(): string
    {
        return 'component.pagination';
    }

    public function render()
    {
        return view('livewire.darts.game.history-darts', [
            'pageGames' => $this->makeQueryFilter(),
        ]);
    }
}

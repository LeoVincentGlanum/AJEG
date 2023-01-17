<?php

namespace App\Http\Livewire\Game;

use App\Enums\GameResultEnum;
use App\ModelStates\GamePlayerResultStates\Draw;
use App\ModelStates\GamePlayerResultStates\Loss;
use App\ModelStates\GamePlayerResultStates\Pat;
use App\ModelStates\GamePlayerResultStates\Win;
use App\ModelStates\GameStates\Validate;
use App\ModelStates\GameStates\ResultValidations;
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

    public function gameResult($game) : string
    {
        if ($game->status->equals(Validate::class)) {
            foreach ($game->gamePlayers as $player) {
                if ($player->result !== null) {
                    if ($player->result->equals(Loss::class)) {
                        continue;
                    }
//                    dd($player->result::class, $player->result::$name);
                    return match ($player->result::$name) {
                        Win::$name => $player->user->name." a gagné",
                        Draw::$name => "Match nul",
                        Pat::$name => "Pat",
                    };
                }
            }
            return "-";
        } elseif($game->status->equals(ResultValidations::class)) {
            foreach ($game->gamePlayers as $player) {
                if ($player->result !== null) {
                    if ($player->result->equals(Loss::class)) {
                        continue;
                    }
                    return match ($player->result) {
                        Win::$name => "[En attente] ".$player->user->name." a gagné",
                        Draw::$name => "[En attente] Match nul",
                        Pat::$name => "[En attente] Pat",
                    };
                }
            }

            return "-";
        }else{
            return "-";
        }



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

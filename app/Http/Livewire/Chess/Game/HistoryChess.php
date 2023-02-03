<?php

namespace App\Http\Livewire\Chess\Game;

use App\Enums\GameResultEnum;
use App\Models\Game;
use App\ModelStates\GamePlayerResultStates\Draw;
use App\ModelStates\GamePlayerResultStates\Loss;
use App\ModelStates\GamePlayerResultStates\Pat;
use App\ModelStates\GamePlayerResultStates\Win;
use App\ModelStates\GameStates\Validate;
use App\ModelStates\GameStates\ResultValidations;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;
use Livewire\WithPagination;
use App\ModelStates\GamePlayerResultStates\PendingResult;

class HistoryChess extends Component
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
                $query->whereHas('users', fn($query) => $query->where('ajeg_users.name', 'like', '%'.$this->searchPlayer.'%')
                    ->where('ajeg_game_players.result', 'like', '%'.$this->searchResult.'%'));
            })
            ->when(($this->searchPlayer !== '' && $this->searchResult === ''), function ($query) {
                $query->whereRelation('users', 'name', 'like', '%'.$this->searchPlayer.'%');
            })
            ->when(($this->searchPlayer === '' && $this->searchResult !== ''), function ($query) {
                $query->whereRelation('users', 'result', 'like', '%'.$this->searchResult.'%');
            })
            ->where("sport_id", 1)
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
                    return match ($player->result::$name) {
                        Win::$name => $player->user->name." a gagné",
                        Draw::$name => "Match nul",
                        Pat::$name => "Pat",
                    };
                }
            }
            return "-";
        }

        if ($game->status->equals(ResultValidations::class)) {
            foreach ($game->gamePlayers as $player) {
                if ($player->result !== null) {
                    if ($player->result->equals(Loss::class)) {
                        continue;
                    }
                    return match ($player->result::$name) {
                        Win::$name => "[En attente] ".$player->user->name." a gagné",
                        Draw::$name => "[En attente] Match nul",
                        PendingResult::$name => "En attente de saisi des resultat",
                        Pat::$name => "[En attente] Pat",
                    };
                }
            }

        }

        return "-";
    }

    public function paginationView(): string
    {
        return 'component.pagination';
    }

    public function render()
    {
        return view('livewire.chess.game.history-chess', [
            'pageGames' => $this->makeQueryFilter(),
        ]);
    }
}

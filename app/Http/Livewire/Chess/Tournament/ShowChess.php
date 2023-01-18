<?php

namespace App\Http\Livewire\Chess\Tournament;

use App\Enums\GameResultEnum;
use App\Models\Game;
use App\Models\Tournament;
use App\ModelStates\GameStates\ResultValidations;
use App\ModelStates\GameStates\Validate;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Livewire\Component;

class ShowChess extends Component
{
    public Tournament $tournament;

    public string $searchStatus = '';

    public string $searchPlayer = '';

    public array $results = [];

    public string $searchResult = '';

    public function mount(Tournament $tournament)
    {
        $this->tournament = $tournament;
        $this->games = Game::query()->with("gamePlayers.user")->where("tournament_id", $tournament->id)->get();

        $this->results = [];
        foreach ($this->games as $game) {
            foreach ($game->gamePlayers as $gamePlayer) {
                $this->results[] = [
                    "game_id" => $gamePlayer->game_id,
                    "user_id" => $gamePlayer->user_id,
                    "result" => $gamePlayer->result
                ];
            }
        }
    }

    public function makeQueryFilter(): LengthAwarePaginator
    {
        return Game::query()
            ->with(['users', 'gamePlayers'])
            ->where("tournament_id", $this->tournament->id)
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
            ->paginate(10);
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

    public function render()
    {
        return view('livewire.chess.tournament.show-chess', [
            'pageGames' => $this->makeQueryFilter(),
            'results' => $this->results,
        ]);
    }
}

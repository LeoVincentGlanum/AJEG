<?php

namespace App\Http\Livewire\Tournament;

use App\Enums\GameResultEnum;
use App\Models\Game;
use App\Models\Tournament;
use App\ModelStates\GamePlayerResultStates\Draw;
use App\ModelStates\GamePlayerResultStates\Loss;
use App\ModelStates\GamePlayerResultStates\Pat;
use App\ModelStates\GamePlayerResultStates\Win;
use App\ModelStates\GameStates\ResultValidations;
use App\ModelStates\GameStates\Validate;
use Livewire\Component;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class Show extends Component
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
        if ($game->status->equals(Validate::class)) {
            foreach ($game->gamePlayers as $player) {
                if ($player->result !== null) {
                    if ($player->result->equals(Loss::class)) {
                        continue;
                    }
                    return match ($player->result::$name) {
                        Win::$name => $player->user->name . " a gagné",
                        Draw::$name => "Match nul",
                        Pat::$name => "Pat",
                    };
                }
            }
            return "-";
        } elseif ($game->status->equals(ResultValidations::class)) {
            foreach ($game->gamePlayers as $player) {
                if ($player->result !== null) {
                    if ($player->result->equals(Loss::class)) {
                        continue;
                    }
                    return match ($player->result::$name) {
                        Win::$name => "[En attente] " . $player->user->name . " a gagné",
                        Draw::$name => "[En attente] Match nul",
                        Pat::$name => "[En attente] Pat",
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
        return view('livewire.tournament.show', [
            'pageGames' => $this->makeQueryFilter(),
            'results' => $this->results,
        ]);
    }
}

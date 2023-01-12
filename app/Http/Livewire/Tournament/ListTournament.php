<?php

namespace App\Http\Livewire\Tournament;

use App\Enums\TournamentStatusEnum;
use App\Enums\TournamentTypeEnum;
use App\Models\GameType;
use App\Models\Tournament;
use App\ModelStates\TournamentType;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;
use Livewire\WithPagination;

class ListTournament extends Component
{
    use WithPagination;

    protected $listeners = ['refreshListTournament'];

    public string $type = '';

    public string $gameType = '';

    public string $tournamentStatus = '';

    public int $minElo = 0;

    public int $maxElo = 7000;

    public function getTypesProperty(): array
    {
        return TournamentTypeEnum::cases();
    }

    public function getGameTypesProperty(): Collection
    {
        return GameType::all();
    }

    public function getStatusProperty(): array
    {
        return TournamentStatusEnum::cases();
    }

    public function refreshListTournament()
    {
        $this->makeQueryFilter();
    }

    public function makeQueryFilter()
    {
//        dd($this);
        return Tournament::query()
            ->with(['organizer', 'gameType', 'participants', 'winner'])
            ->when($this->type !== '',
                fn($query) => $query->whereType('type', TournamentTypeEnum::mapWithStateMachine($this->type))
            )
            ->when($this->gameType !== '',
                fn($query) => $query->where('game_type_id', '=', $this->gameType)
            )
            ->when($this->tournamentStatus !== '',
                fn($query) => $query->where('status', $this->tournamentStatus)
            )
            ->when($this->minElo !== 0 && $this->maxElo !== 7000,
                fn($query) => $query->where('elo_min', '>=', $this->minElo)->where('elo_max', '<=', $this->maxElo)
            )
            ->when($this->minElo === 0 && $this->maxElo !== 7000,
                fn($query) => $query->where('elo_max', '<=', $this->maxElo)
            )
            ->when($this->minElo !== 0 && $this->maxElo === 7000,
                fn($query) => $query->where('elo_min', '>=', $this->minElo)
            );
    }

    public function resetFilter()
    {
        $this->reset(['type', 'gameType', 'tournamentStatus', 'minElo', 'maxElo']);
        $this->goToPage(1);
    }

    public function render()
    {
        return view('livewire.tournament.list-tournament', [
            'tournaments' => $this->makeQueryFilter()->paginate(10)
        ]);
    }
}

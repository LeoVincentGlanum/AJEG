<?php

namespace App\Http\Livewire\Tournament;

use App\Models\GameType;
use App\Models\Tournament;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class TournamentEdit extends Component
{
    public Tournament $tournament;

    protected array $rules = [
        'tournament.name' => 'required|string|max:255',
        'tournament.number_of_players' => 'required',
        'tournament.entrance_fee' => 'required',
        'tournament.game_type_id' => 'required',
    ];

    public function getGameTypesProperty(): Collection
    {
        return GameType::all();
    }

    public function mount(Tournament $tournament)
    {
        $this->tournament = $tournament;
    }

    public function render()
    {
        return view('livewire.tournament.tournament-edit');
    }
}

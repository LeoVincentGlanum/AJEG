<?php

namespace App\Http\Livewire\Tournament;

use App\Models\GameType;
use App\Models\Tournament;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class TournamentEdit extends Component
{
    public Tournament $tournament;

    public array $results = [];

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

    public function getPlayersProperty(): Collection
    {
        return $this->tournament->participants;
    }

    public function mount(Tournament $tournament)
    {
        $this->tournament = $tournament;
    }

    public function cancel()
    {
        try {
            $this->tournament->update(['status_id' => 5]);
            $this->dispatchBrowserEvent('toast', ['message' => 'Le tournoi est annulé', 'type' => 'success']);
        } catch (\Exception $e) {
            $this->dispatchBrowserEvent('toast', ['message' => $e->getMessage(), 'type' => 'error']);
        }
    }

    public function start()
    {
        try {
            $this->tournament->update([
                'status_id' => 3,
                'start_date' => now()
            ]);
            $this->dispatchBrowserEvent('toast', ['message' => 'Le tournoi a commencé', 'type' => 'success']);
        } catch (\Exception $e) {
            $this->dispatchBrowserEvent('toast', ['message' => $e->getMessage(), 'type' => 'error']);
        }
    }

    public function save()
    {

    }

    public function register()
    {

    }

    public function render()
    {
        return view('livewire.tournament.tournament-edit');
    }
}

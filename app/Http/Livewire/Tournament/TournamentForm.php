<?php

namespace App\Http\Livewire\Tournament;

use App\Models\GameType;
use App\Models\Tournament;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use LivewireUI\Modal\ModalComponent;

class TournamentForm extends ModalComponent
{
    public Tournament $tournament;

    public string|null $selectedGameType = null;

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

    public function mount() {
        $this->tournament = new Tournament();
        $user = Auth::user();
        $this->tournament->name = "Tournois de " . $user->name;
    }

    public function save()
    {
        $this->validate();

        try {
            $this->tournament->organizer_id = Auth::id();
            $this->tournament->status_id = 1;
            $this->tournament->save();
            $this->dispatchBrowserEvent('toast', ['message' => 'Le tournoi a bien été créé', 'type' => 'success']);
        } catch (\Exception $e) {
            Log::info($e->getMessage());
            $this->dispatchBrowserEvent('toast', ['message' => $e->getMessage(), 'type' => 'error']);
        }

        $this->closeModalWithEvents([ListTournament::getName() => ['refreshListTournament', []]]);
    }

    public function render()
    {
        return view('livewire.tournament.tournament-form');
    }
}

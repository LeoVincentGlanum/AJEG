<?php

namespace App\Http\Livewire\Tournament;

use App\Models\Tournament;
use App\Models\TournamentParticipant;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use LivewireUI\Modal\ModalComponent;

class TournamentRegister extends ModalComponent
{
    public ?Tournament $tournament;

    public function mount($id)
    {
        try {
            $this->tournament = Tournament::query()->with(['participants'])->findOrFail($id);
        } catch (\Exception $e) {
            $this->tournament = null;
        }
    }

    public function register()
    {
        $nbParticipants = $this->tournament->participants->count();

        if ($nbParticipants >= $this->tournament->number_of_players) {
            $this->dispatchBrowserEvent('toast', ['message' => 'Le tournoi est complet', 'type' => 'error']);
            return;
        }

        if ($this->tournament->participants->where('id', '=', Auth::id())->isNotEmpty()) {
            $this->dispatchBrowserEvent('toast', ['message' => 'Vous êtes déjà inscrit', 'type' => 'error']);
            return;
        }

        DB::beginTransaction();
        try {
            $newParticipation = new TournamentParticipant();
            $newParticipation->tournament_id = $this->tournament->id;
            $newParticipation->user_id = Auth::id();
            $newParticipation->save();

            if ($nbParticipants + 1 === $nbParticipants) {
                $this->tournament->status_id = 2;
                $this->tournament->save();
            }

            $this->dispatchBrowserEvent('toast', ['message' => 'Votre inscription a bien été prise en compte', 'type' => 'success']);
        } catch (\Exception $e) {
            DB::rollBack();
            $this->dispatchBrowserEvent('toast', ['message' => $e->getMessage(), 'type' => 'error']);
        }
        DB::commit();

        $this->closeModalWithEvents([ListTournament::getName() => ['refreshListTournament', []]]);
    }

    public function render()
    {
        return view('livewire.tournament.tournament-register');
    }
}

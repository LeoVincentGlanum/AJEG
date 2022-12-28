<?php

namespace App\Http\Livewire\Tournament;

use App\Http\Livewire\Traits\HasToast;
use App\Models\Tournament;
use App\Models\TournamentParticipant;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use LivewireUI\Modal\ModalComponent;

class Register extends ModalComponent
{
    use HasToast;

    public ?Tournament $tournament;

    public function mount($id)
    {
        try {
            $this->tournament = Tournament::query()->with(['participants'])->findOrFail($id);
        } catch (\Throwable $e) {
            $this->tournament = null;
        }
    }

    public function register()
    {
        $nbParticipants = $this->tournament->participants->count();

        if ($nbParticipants >= $this->tournament->number_of_players) {
            $this->errorToast('The tournament is full');
            return;
        }

        if ($this->tournament->participants->where('id', '=', Auth::id())->isNotEmpty()) {
            $this->errorToast('You are already registered');
            return;
        }

        try {
            $newParticipation = new TournamentParticipant();
            $newParticipation->tournament_id = $this->tournament->id;
            $newParticipation->user_id = Auth::id();
            $newParticipation->save();

            $this->successToast('Your registration has been successful');
        } catch (\Throwable $e) {
            Log::error($e->getMessage());
            $this->errorToast('An error occurred during your registration');
        }

        $this->closeModalWithEvents([ListTournament::getName() => ['refreshListTournament', []]]);
    }

    public function render()
    {
        return view('livewire.tournament.register');
    }
}

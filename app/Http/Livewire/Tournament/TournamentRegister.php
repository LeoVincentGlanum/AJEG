<?php

namespace App\Http\Livewire\Tournament;

use App\Models\Tournament;
use LivewireUI\Modal\ModalComponent;

class TournamentRegister extends ModalComponent
{
    public ?Tournament $tournament;

    public function mount($id)
    {
        try {
            $this->tournament = Tournament::query()->findOrFail($id);
        } catch (\Exception $e) {
            $this->tournament = null;
        }
    }

    public function register()
    {
        try {

        } catch (\Exception $e) {

        }
    }

    public function render()
    {
        return view('livewire.tournament.tournament-register');
    }
}

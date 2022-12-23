<?php

namespace App\Http\Livewire\Dashboard;

use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class ListTournaments extends Component
{
    public array|Collection $tournaments;

    public function mount()
    {
        try {
            $this->tournaments = [];
        } catch (\Exception $e) {
            $this->tournaments = [];
            $this->dispatchBrowserEvent('toast', [
                'message' => 'Une erreur est survenu pendant la récupération de vos tournois',
                'type' => 'error'
            ]);
        }
    }

    public function render()
    {
        return view('livewire.dashboard.list-tournaments');
    }
}

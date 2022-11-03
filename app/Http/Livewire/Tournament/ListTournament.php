<?php

namespace App\Http\Livewire\Tournament;

use App\Models\Tournament;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class ListTournament extends Component
{
    public Collection $tournaments;

    protected $listeners = ['refreshListTournament'];

    public function mount()
    {
        $this->tournaments = Tournament::query()->with(['organizer', 'gameType', 'participants', 'status', 'winner'])->get();
    }

    public function refreshListTournament()
    {
        $this->tournaments = Tournament::query()->with(['organizer', 'gameType', 'status', 'winner'])->get();
    }

    public function render()
    {
        return view('livewire.tournament.list-tournament');
    }
}

<?php

namespace App\Http\Livewire\Chess\Tournament;

use App\Models\Tournament;
use Livewire\Component;

class ListOngoingTournaments extends Component
{
    public function render()
    {
        return view('livewire.chess.tournament.list-ongoing-tournaments');
    }
}

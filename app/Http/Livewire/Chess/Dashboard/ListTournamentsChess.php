<?php

namespace App\Http\Livewire\Chess\Dashboard;

use App\Http\Livewire\Traits\HasToast;
use App\Models\Tournament;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Livewire\Component;

class ListTournamentsChess extends Component
{
    use HasToast;

    public array|Collection $tournaments;

    public function mount()
    {
        try {
            $this->tournaments = Tournament::query()
                ->with('participants')
                ->whereHas('participants', function ($query) {
                    $query->where('user_id', Auth::user()->id);
                })
                ->where('status', '!=', 'Terminé')
                ->where('sport_id', 1)
                ->get();
        } catch (\Throwable $e) {
            report($e);
            $this->tournaments = [];

        }
    }

    public function render()
    {
        return view('livewire.chess.dashboard.list-tournaments-chess');
    }

}

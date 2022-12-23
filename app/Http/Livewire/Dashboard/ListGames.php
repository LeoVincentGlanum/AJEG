<?php

namespace App\Http\Livewire\Dashboard;

use App\Models\Game;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class ListGames extends Component
{
    public array|Collection $games;

    public function mount()
    {
        try {
            $this->games = Game::query()
                ->with('users')
                ->whereHas('gamePlayers', function ($query) {
                    $query->where('user_id', auth()->user()->id)->orWhere('created_by', auth()->user()->id);
                })
                ->where('status', '!=', 'Terminé')
                ->get();
        } catch (\Exception $e) {
            $this->games = [];
            $this->dispatchBrowserEvent('toast', [
                'message' => 'Une erreur est survenu pendant la récupération de vos partie',
                'type' => 'error'
            ]);
        }
    }

    public function render()
    {
        return view('livewire.dashboard.list-games');
    }
}

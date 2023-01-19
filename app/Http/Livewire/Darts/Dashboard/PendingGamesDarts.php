<?php

namespace App\Http\Livewire\Darts\Dashboard;

use App\Models\Game;
use App\ModelStates\GameStates\GameAccepted;
use App\ModelStates\GameStates\PlayersValidation;
use Illuminate\Support\Collection;
use Livewire\Component;

class PendingGamesDarts extends Component
{

    public array|Collection $games;

    public function mount()
    {
        try {
            $this->games = Game::query()
                ->with('users')
                ->whereHas('gamePlayers', function ($query) {
                    $query->where('user_id', auth()->user()->id);
                })
                ->where(function ($query) {
                    $query->where('status', '=', PlayersValidation::$name)
                        ->orWhere('status', GameAccepted::$name);
                })
                ->where('sport_id', 2)
                ->get();
        } catch (\Throwable $e) {
            report($e);
            $this->games = [];
        }
    }

    public function render()
    {
        return view('livewire.darts.dashboard.pending-games-darts');
    }
}

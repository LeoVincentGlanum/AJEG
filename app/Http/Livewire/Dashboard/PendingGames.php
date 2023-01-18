<?php

namespace App\Http\Livewire\Dashboard;

use App\Models\Game;
use App\ModelStates\GameStates\GameAccepted;
use App\ModelStates\GameStates\PlayersValidation;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Illuminate\Support\Facades\Route;

class PendingGames extends Component
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
                ->get();
        } catch (\Throwable $e) {
            report($e);
            $this->games = [];
        }
    }

    public function render()
    {
         if (str_contains(Route::currentRouteName(), 'darts')) {
            return view('livewire.darts.dashboard.pending-games');
        } else {
            return view('livewire.chess.dashboard.pending-games');
        }
    }
}

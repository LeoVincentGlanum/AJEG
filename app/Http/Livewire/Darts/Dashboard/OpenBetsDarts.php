<?php

namespace App\Http\Livewire\Darts\Dashboard;

use App\Models\Game;
use App\ModelStates\GameStates\GameAccepted;
use App\ModelStates\GameStates\PlayersValidation;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Route;
use Livewire\Component;

class OpenBetsDarts extends Component
{
    public array|Collection $games;

    public function mount()
    {
//        dd(auth()->user()->id);
        try {
            $this->games = Game::query()
                ->with('users')
                ->whereDoesntHave('gamePlayers', function ($query) {
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
//        foreach ($this->games as $game){
//        dd($game);
//
//        }
    }

    public function render()
    {
            return view('livewire.darts.dashboard.open-bets-darts');
    }
}

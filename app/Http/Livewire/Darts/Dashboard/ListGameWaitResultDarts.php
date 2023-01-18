<?php

namespace App\Http\Livewire\Darts\Dashboard;

use App\Http\Livewire\Traits\HasToast;
use App\Models\Game;
use Illuminate\Support\Collection;
use Livewire\Component;

class ListGameWaitResultDarts extends Component
{

    use HasToast;

    public array|Collection $games;

    public function mount()
    {
        try {
            $this->games = Game::query()
                ->with('users')
                ->whereHas('gamePlayers', function ($query) {
                    $query->where('user_id', auth()->user()->id)->orWhere('created_by', auth()->user()->id);
                })
                ->where('status', '=', 'resultvalidations')
                ->get();
        } catch (\Throwable $e) {
            report($e);
            $this->games = [];
        }
    }

    public function render()
    {
        return view('livewire.darts.dashboard.list-game-wait-result-darts');
    }
}

<?php

namespace App\Http\Livewire\Chess\Dashboard;

use App\Http\Livewire\Traits\HasToast;
use App\Models\Game;
use Illuminate\Support\Collection;
use Livewire\Component;

class ListGameWaitResultChess extends Component
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

        return view('livewire.chess.dashboard.list-game-wait-result-chess');

    }
}

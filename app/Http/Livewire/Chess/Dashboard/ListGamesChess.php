<?php

namespace App\Http\Livewire\Chess\Dashboard;

use App\Http\Livewire\Traits\HasToast;
use App\Models\Game;
use App\ModelStates\GameStates\InProgress;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class ListGamesChess extends Component
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
                ->Where('status', '=', InProgress::$name)
                ->where('sport_id', 1)
                ->get();
        } catch (\Throwable $e) {
            report($e);

            $this->games = [];
            $this->errorToast('An error occurred while retrieving your games');
        }
    }

    public function render()
    {
        return view('livewire.chess.dashboard.list-games-chess');
    }
}

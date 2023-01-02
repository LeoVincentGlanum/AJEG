<?php

namespace App\Http\Livewire\Dashboard;

use App\Models\Game;
use Livewire\Component;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use App\Http\Livewire\Traits\HasToast;

class ListGameWaitResult extends Component
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
            Log::error($e->getMessage());
            $this->games = [];
            $this->errorToast('An error occurred while retrieving your games');
        }
    }
    public function render()
    {
        return view('livewire.dashboard.list-game-wait-result');
    }
}

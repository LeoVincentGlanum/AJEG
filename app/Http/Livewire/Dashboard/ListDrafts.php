<?php

namespace App\Http\Livewire\Dashboard;

use App\Models\Game;
use Livewire\Component;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;

class ListDrafts extends Component
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
                ->where('status', '=', 'draft')
                ->get();
        } catch (\Throwable $e) {
            report($e);
            $this->games = [];
        }
    }

    public function render()
    {
        if (str_contains(Route::currentRouteName(), 'darts')) {
            return view('livewire.darts.dashboard.list-drafts');
        } else {
            return view('livewire.chess.dashboard.list-drafts');
        }

    }
}

<?php

namespace App\Http\Livewire\Darts\Dashboard;

use App\Models\Game;
use Illuminate\Support\Collection;
use Livewire\Component;

class ListDraftsDarts extends Component
{


    public array|Collection $games;

    public function mount()
    {
        try {
           $this->games = Game::query()
                ->with('users')
                ->where(function ($query) {
                    $query->
                    whereHas('gamePlayers', function ($query) {
                        $query->where('user_id', auth()->user()->id);
                    })
                        ->orWhere('created_by', auth()->user()->id);
                })
                ->where('status', "=", 'draft')
                ->where('sport_id', 2)
                ->get();
        } catch (\Throwable $e) {
            report($e);
            $this->games = [];
        }
    }

    public function render()
    {
        return view('livewire.darts.dashboard.list-drafts-darts');

    }
}

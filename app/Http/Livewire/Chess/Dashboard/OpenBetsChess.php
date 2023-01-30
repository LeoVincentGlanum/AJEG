<?php

namespace App\Http\Livewire\Chess\Dashboard;

use Illuminate\Support\Facades\Auth;
use App\Http\Livewire\Admin\ListGameType;
use App\Http\Livewire\Traits\HasToast;
use App\Models\Game;
use App\ModelStates\GameStates\GameAccepted;
use App\ModelStates\GameStates\PlayersValidation;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Livewire\Component;


class OpenBetsChess extends Component
{

    public array|Collection $games;
    public Game $game;

    use HasToast;


    public $bet_notif = false;

    public function mount()
    {
        try {
            $user = Auth::user();
            $this->bet_notif = $user->bet_notif;
            $this->games = Game::query()
                ->with('users')
                ->whereDoesntHave('gamePlayers', function ($query) {
                    $query->where('user_id', auth()->user()->id);
                })
                ->where(function ($query) {
                    $query->where('status', '=', PlayersValidation::$name)
                        ->orWhere('status', GameAccepted::$name);
                })
                ->where('sport_id', 1)
                ->orderByDesc('id')
                ->get();
        } catch (\Throwable $e) {
            report($e);
            $this->games = [];
        }
    }

    public function delete($id)
    {
        $game = Game::query()->where('id', $id)->first();

        try {
            $game->delete();
            $this->successToast('the game has been deleted');
        } catch (\Throwable $e) {
            Log::error($e->getMessage() . $e->getTraceAsString());
            $this->errorToast('An error occurred while deleting this game');
        }

        $this->mount();

        return $this->games;
    }

    public function render()
    {
        return view('livewire.chess.dashboard.open-bets-chess');
    }
}

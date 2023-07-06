<?php

namespace App\Http\Livewire\Chess\Game;

use App\Http\Livewire\Traits\HasToast;
use App\Models\Game;
use App\Models\GamePlayer;
use App\Models\User;
use App\ModelStates\GameStates\GameAccepted;
use App\ModelStates\GameStates\InProgress;
use App\ModelStates\PlayerParticipationStates\Accepted;
use App\ModelStates\PlayerParticipationStates\Declined;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ChangeStatusGameToStart extends Component
{
    use HasToast;

    public function getGamesProperty()
    {
         return Game::query()
                ->where('status', 'gameaccepted')
                ->whereHas('gamePlayers', function ($query) {
                    $query->where('user_id', Auth::id());
                })
                ->get();
    }

    public function getNameOpponent($game)
    {
        if ($game->GamePlayers[0]->user_id === Auth::id()){
            return User::query()
                ->where('id', $game->GamePlayers[1]->user_id)
                ->first()
                ->name;
        }

        if ($game->GamePlayers[1]->user_id === Auth::id()){
            return User::query()
                ->where('id', $game->GamePlayers[0]->user_id)
                ->first()
                ->name;
        }

        return 'error';
    }

    public function acceptInvitation(Game $game)
    {
        $game = Game::query()
            ->where('id', $game->id)
            ->first();

        $game->status->transitionTo(InProgress::class);

        $this->dispatchBrowserEvent('toast', [
            'message' => __('The game has started'),
            'type' => 'success'
        ]);
    }

    public function render()
    {
        return view('livewire.chess.game.change-status-game-to-start');
    }
}

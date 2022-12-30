<?php

namespace App\Http\Livewire\Game;

use App\Models\Game;
use App\Models\GamePlayer;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Illuminate\Database\Eloquent\Collection;

class Show extends Component
{
    public Game $game;

    public Collection $gamePlayer;

    public GamePlayer $CurrentUserGame;


    protected $listeners = ['refreshListPlayer'];
    public function mount($game)
    {
        $this->game = $game;
        $this->gamePlayer = $game->gamePlayers;

        $this->CurrentUserGame = $this->gamePlayer->where('user_id' ,'=', Auth::id())->first();
    }

    public function refreshListPlayer()
    {
        $this->gamePlayer = $this->game->gamePlayers;
    }
    public function acceptInvitation()
    {
        $this->CurrentUserGame->player_participation_validation->transitionTo(\App\ModelStates\PlayerParticipationStates\Accepted::class) ;
        $this->emitSelf('refreshListPlayer');
    }

    public function refuseInvitation()
    {
        $this->CurrentUserGame->player_participation_validation->transitionTo(\App\ModelStates\PlayerParticipationStates\Declined::class) ;
        $this->emitSelf('refreshListPlayer');
    }
    public function render()
    {
        return view('livewire.game.show');
    }
}

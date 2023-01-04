<?php

namespace App\Http\Livewire\Game;

use App\Models\Game;
use App\ModelStates\GameStates\InProgress;
use App\ModelStates\PlayerParticipationStates\Pending;
use Livewire\Component;
use App\Models\GamePlayer;
use Illuminate\Support\Facades\Auth;
use App\Http\Livewire\Traits\HasToast;
use App\ModelStates\GameStates\Validate;
use App\ModelStates\GameStates\GameAccepted;
use Illuminate\Database\Eloquent\Collection;
use App\ModelStates\PlayerResultStates\Accepted;
use App\Http\Livewire\Game\Traits\HasGameResultMapper;

class Show extends Component
{

     use HasGameResultMapper, HasToast;
    public Game $game;
    public ?GamePlayer $winner;
    public Collection $gamePlayer;

    public GamePlayer $CurrentUserGame;


    protected $listeners = ['refreshListPlayer'];
    public function mount($game)
    {
        $this->game = $game;
        $this->gamePlayer = $game->gamePlayers;
        $this->winner = $game->gamePlayers->toQuery()->where('result','=','win')->first();
        $this->CurrentUserGame = $this->gamePlayer->where('user_id' ,'=', Auth::id())->first();

    }

    public function accept(){
        $allCompleted = true;
        foreach ($this->gamePlayer as $player){
            if ($player->user_id === Auth::id()){
                $player->player_result_validation->transitionTo(Accepted::class);
                $player->save();
            }
            if ($player->player_result_validation == "pending"){
                $allCompleted = false;
            }
        }
        if($allCompleted){
            $this->game->status->transitionTo(Validate::class);
            $this->game->save();
        }

        $this->dispatchBrowserEvent('toast', ['message' => __("You approved the result !"), 'type' => 'success']);
        redirect()->route('dashboard');
    }

    public function decline(){
        dd("perdu");

    }

    public function refreshListPlayer()
    {
        $this->gamePlayer = $this->game->gamePlayers;
    }
    public function acceptInvitation()
    {
        $allCompleted = true;
        foreach ($this->gamePlayer as $player){
             if ($player->user_id === Auth::id()){
                $player->player_participation_validation->transitionTo(\App\ModelStates\PlayerParticipationStates\Accepted::class);
                $player->save();
            }
            if ($player->player_participation_validation === Pending::$name){
                $allCompleted = false;
            }
        }
        if($allCompleted){
            $this->game->status->transitionTo(GameAccepted::class);
            $this->game->save();
        }
        $this->successToast('You accepted the game');
        $this->emitSelf('refreshListPlayer');
    }
    public function LaunchGame()
    {
        $this->game->status->transitionTo(InProgress::class);

        $this->successToast('Game is now launch dont forget close bet');
        $this->emitSelf('refreshListPlayer');
    }
    public function refuseInvitation()
    {
        $this->CurrentUserGame->player_participation_validation->transitionTo(\App\ModelStates\PlayerParticipationStates\Declined::class);
        $this->emitSelf('refreshListPlayer');
    }
    public function render()
    {
        return view('livewire.game.show');
    }
}

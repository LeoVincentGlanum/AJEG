<?php

namespace App\Http\Livewire\Notifications;

use App\Models\Bet as GameBet;
use App\Models\Game;
use App\Models\User;
use App\ModelStates\BetStates\PendingBet;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use LivewireUI\Modal\ModalComponent;

class BetGame extends ModalComponent
{
    public Game $currentGame;

    public Collection $gamePlayer;

    public array $gameplayer_id;

    public bool $showInput = false;

    public bool $enableValidation = false;
    public int $bet = 0;
    public float $ratio;
    public int $gain = 0;

    public function mount(int $game)
    {
        $this->currentGame = Game::find($game);
        $this->gamePlayer = $this->currentGame->gamePlayers;

    }

    public function render()
    {
        return view('livewire.notifications.bet-game');
    }

    public function initBet($ratio, $player)
    {
        $this->ratio = $ratio;
        $this->gameplayer_id = $player;
        if ($this->bet !== 0) {
            $this->gain = $this->bet * $this->ratio;
        }
    }

    public function updateGain()
    {
        $this->enableValidation = !($this->bet > Auth::user()->coins);
        $this->gain = $this->bet * $this->ratio;
    }

    public function saveBet()
    {
        try {
            $newBet = new GameBet();
            $newBet->game_id = $this->currentGame->id;
            $newBet->gambler_id = Auth::id();
            $newBet->gameplayer_id = $this->gameplayer_id['id'];
            $newBet->bet_deposit = $this->bet;
            $newBet->bet_gain = $this->gain;
            $newBet->bet_status = PendingBet::$name;

            $canBet = Auth::user()->coins >= $this->bet;

            if ($canBet && $newBet->save()) {
                User::query()->where('id', Auth::id())->decrement('coins', $this->bet);

                session()->flash('message', 'Votre paris a bien été enregistré.');
                return redirect()->route('game.show', $this->currentGame->id);
            }

        } catch (\Exception $exception) {
            session()->flash('alert-class', 'alert-danger');
            session()->flash('message', 'Une erreur est survenue');
            return redirect()->route('game.show', $this->currentGame->id);
        }
    }
}

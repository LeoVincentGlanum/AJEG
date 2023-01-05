<?php

namespace App\Http\Livewire\Game;

use App\Models\Game;
use App\Models\Bet as GameBet;
use App\Models\GamePlayer;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Bet extends Component
{
    public Game $game;

    public Collection $gamePlayer;

    public array $gameplayer_bet;

    public bool $showInput = false;

    public bool $enableValidation = false;
    public int $bet = 0;
    public float $ratio;
    public int $gain = 0;

    public function mount($game)
    {
        $this->game = $game;
        $this->gamePlayer = $game->gamePlayers;
    }

    public function render()
    {
        return view('livewire.game.bet');
    }

    public function initBet($ratio, $player)
    {
        $this->ratio = $ratio;
        $this->gameplayer_bet = $player;
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
            $newBet->game_id = $this->game->id;
            $newBet->gambler_id = Auth::id();
            $newBet->gameplayer_bet = $this->gameplayer_bet['id'];
            $newBet->bet_deposit = $this->bet;
            $newBet->bet_gain = $this->gain;
            $newBet->bet_status = "Pending";

            if ($newBet->save()) {
                User::query()->where('id', Auth::id())->decrement('coins', $this->bet);

                session()->flash('message', 'Votre paris a bien été enregistré.');
                return redirect()->route('game.show', $this->game->id);
            }

        } catch (\Exception $exception) {
            dd($exception);
        }
    }
}

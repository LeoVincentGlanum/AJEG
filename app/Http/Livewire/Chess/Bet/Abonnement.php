<?php

namespace App\Http\Livewire\Chess\Bet;

use Livewire\Component;
use LivewireUI\Modal\ModalComponent;
use Illuminate\Support\Facades\Auth;
use App\Http\Livewire\Traits\HasToast;
use App\Http\Livewire\Chess\Dashboard\OpenBetsChess;
use App\Http\Livewire\Chess\Notifications\BetGameChess;

class Abonnement extends ModalComponent
{

    use HasToast;

    public $bet_notif = false;

    public function mount(){
        $user = Auth::user();
        $this->bet_notif = $user->bet_notif;

    }

    public function save(){

        $user = Auth::user();

        if ($this->bet_notif){
            $user->bet_notif = false;
            $this->bet_notif = false;
        } else {
            $user->bet_notif = true;
            $this->bet_notif = true;
        }

        $user->save();


        $this->successToast('Vous avez souscris à SuperBet, vous recevez maintenant les paris par mail');
        $this->closeModalWithEvents([OpenBetsChess::getName() => ['subBetClose',[$this->bet_notif]]]);

    }

    public function render()
    {
        return view('livewire.chess.bet.abonnement');
    }

}

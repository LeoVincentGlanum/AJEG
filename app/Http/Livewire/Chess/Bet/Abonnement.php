<?php

namespace App\Http\Livewire\Chess\Bet;

use Livewire\Component;
use LivewireUI\Modal\ModalComponent;
use Illuminate\Support\Facades\Auth;
use App\Http\Livewire\Traits\HasToast;

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
        $user->bet_notif = true;
        $user->save();

        $this->successToast('Vous avez souscris à SuperBet, vous recevez maintenant les paris par mail');
        $this->closeModal();

    }

    public function render()
    {
        return view('livewire.chess.bet.abonnement');
    }

}

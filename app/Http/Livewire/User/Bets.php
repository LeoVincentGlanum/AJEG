<?php

namespace App\Http\Livewire\User;

use App\Http\Livewire\Traits\HasToast;
use App\Models\Bet;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;

class Bets extends Component
{
    use WithFileUploads, HasToast;

    public function mount(){
        $this->bets = Bet::query()->with("gamePlayers.user")->where("gambler_id", Auth::id())->get();
//        dd($this->bets);
    }

    public function render()
    {
        return view('livewire.user.bets',[
            "bets" => $this->bets
        ]);
    }
}

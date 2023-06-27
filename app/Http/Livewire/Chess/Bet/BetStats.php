<?php

namespace App\Http\Livewire\Chess\Bet;

use App\Models\Bet;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class BetStats extends Component
{
    public int $totalSaison = 0;

    public function mount()
    {
        $user_id = Auth::id();

        $betsUser = Bet::query()
                        ->where('gambler_id',$user_id)
                        ->get();

        foreach($betsUser as $betUser){
            if ($betUser->bet_status == 'Win'){
                $this->totalSaison += $betUser->bet_gain;
            }
            elseif ($betUser->bet_status == 'Lost') {
                $this->totalSaison -= $betUser->bet_deposit;
            }
        }
    }

    public function render()
    {
        return view('livewire.chess.bet.bet-stats');
    }
}

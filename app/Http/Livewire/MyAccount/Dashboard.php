<?php

namespace App\Http\Livewire\MyAccount;

use App\Models\GamePlayer;
use App\Models\User;
use Livewire\Component;

class Dashboard extends Component
{
//    public function mount($id){
//        $this->id = $id;
//    }

    public function render($id)
    {
        dd($id);
//        $id = $this->id;
        $user = User::query()->where('id',$id)->first();
        $userGames = GamePlayer::query()->where('user_id', $user->id)->get();
        $totalGames = 0;
        $win = 0;
        $lose = 0;
        $path = 0;
        $null = 0;
        $isWaiting = 0;

        foreach ($userGames as $userGame) {
            if ($userGame->result === 'win') {
                $win++;
            } elseif ($userGame->result === 'lose') {
                $lose++;
            } elseif ($userGame->result === 'path') {
                $path++;
            } elseif ($userGame->result === 'null') {
                $null++;
            }
            elseif ($userGame->result === null) {
                $isWaiting++;
            }
            $totalGames++;
        }
        return view('livewire.my-account.dashboard',compact('win',
                'lose',
                'path',
                'null',
                'totalGames',
                'isWaiting',
                'user')
        );
    }
}

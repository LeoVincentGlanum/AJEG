<?php

namespace App\Http\Controllers;

use App\Models\GamePlayer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\StoreAccountRequest;

class AccountController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreAccountRequest  $request
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(StoreAccountRequest $request)
    {
        $pseudo       = $request->input('pseudo');
        $password     = $request->input('password');
        $confpassword = $request->input('confpassword');



        $user = new User();
        $user->pseudo = $pseudo;
        $user->password = Hash::make($password);
        $user->save();

       return  redirect()->back();
    }

    public function login(){
        return view('dashboard');
    }

    public function myaccount(){
        $user = auth()->user()->first();
        $userGames = GamePlayer::query()->where('user_id', $user->id)->get();
        $totalGames = 0;
        $win = 0;
        $lose = 0;
        $path = 0;
        $null = 0;

        foreach ($userGames as $userGame) {
            if($userGame->result === 'win'){
                $win++;
            }elseif ($userGame->result === 'lose'){
                $lose++;
            }elseif ($userGame->result === 'path'){
                $path++;
            }elseif ($userGame->result === 'null'){
                $null++;
            }
            $totalGames++;
        }
        dd($user->name,
            'win '.$win,
        'lose '.$lose,
        'path '.$path,
        'null '.$null,
        'Total game '.$totalGames);
        return view('myaccount');
    }
}

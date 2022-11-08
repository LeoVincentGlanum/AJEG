<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\GamePlayer;
use App\Models\Transaction;
use App\Models\User;
use Carbon\Carbon;
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

    public function login()
    {
        $games = Game::with('users');
        $games->whereHas('gamePlayers', function ($query) {
            $query->where('user_id', auth()->user()->id)
                  ->orWhere('created_by',  auth()->user()->id);
        })->where('status', '!=', 'Terminé')
          ->get();

        return view('dashboard', [
            'games' => $games
        ]);
    }

    public function myaccount()
    {
        $user = auth()->user()->first();
        $userGames = GamePlayer::query()->where('user_id', $user->id)->get();
        $totalGames = 0;
        $win = 0;
        $lose = 0;
        $path = 0;
        $null = 0;

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
            $totalGames++;
        }

        return view('myaccount', compact('win',
            'lose',
            'path',
            'null',
            'totalGames'));
    }

    public function profileUser($id)
    {
        $user = User::query()->where('id',$id)->first();

        return view('profileUser', compact(
            'user'));
    }

    public function dailyReward()
    {
        if(((Carbon::parse(auth()->user()->daily_reward))->greaterThan(now()->timezone('Europe/Paris')->format('Y-m-d H:i:m')))){
            return redirect()->back();
        }
        $user = auth()->user();
        $user->coins = $user->coins + 100;
        $user->daily_reward = now()->timezone('Europe/Paris')->addDays(1);
        $user->save();

        $transaction = new Transaction();
        $transaction->user_id = $user->id;
        $transaction->coins = 100;
        $transaction->message = "Récompense quotidienne";
        $transaction->save();

        return redirect()->back();
    }

}

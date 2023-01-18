<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Contracts\View\View;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\Collection;

class GameDartsController extends Controller
{
    public function show(Game $game): Factory|View|Application
    {
        return view('darts.game.show-darts', ['game' => $game]);

    }

    public function create(Game $game)
    {
        return view('darts.game.create-darts', ['game' => $game]);

    }

    public function bet(Game $game)
    {
        return view('darts.game.bet-darts', ['game' => $game]);

    }

    public function ranking(Collection $users)
    {
        return view('darts.game.ranking-darts', ['users' => $users, 'page' => request()->get('page')]);


    }

}

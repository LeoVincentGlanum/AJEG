<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Contracts\View\View;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\Collection;

class GameChessController extends Controller
{
    public function show(Game $game): Factory|View|Application
    {
        return view('chess.game.show-chess', ['game' => $game]);

    }

    public function create(Game $game)
    {
        return view('chess.game.create-chess', ['game' => $game]);

    }

    public function bet(Game $game)
    {
        return view('chess.game.bet-chess', ['game' => $game]);

    }

    public function ranking(Collection $users)
    {
        return view('chess.game.ranking-chess', ['users' => $users, 'page' => request()->get('page')]);


    }

}

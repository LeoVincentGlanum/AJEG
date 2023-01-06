<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Contracts\View\View;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\Collection;

class GameController extends Controller
{
    public function show(Game $game) : Factory|View|Application
    {
        return view('game.show', ['game' => $game]);
    }

    public function create(Game $game)
    {
        return view('game.create',['game' => $game]);
    }

    public function ranking(Collection $users)
    {
        return view('game.ranking', ['users' => $users, 'page' => request()->get('page')]);
    }
}

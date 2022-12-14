<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\Foundation\Application;

class GameController extends Controller
{
    public function create() : Factory|View|Application
    {
        return view('game.create');
    }
    public function show($id) : Factory|View|Application
    {
        $game = Game::find($id);

        return view('game.show')->with(['game' => $game]);
    }
}

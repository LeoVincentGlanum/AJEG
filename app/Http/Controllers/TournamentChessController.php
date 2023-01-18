<?php

namespace App\Http\Controllers;

use App\Models\Tournament;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class TournamentChessController extends Controller
{
    public function show(Tournament $tournament): Factory|View|Application
    {
        return view('chess.tournament.show-chess', ['tournament' => $tournament]);

    }

    public function edit(Tournament $tournament): Factory|View|Application
    {

        return view('chess.tournament.edit-chess', ['tournament' => $tournament]);

    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Tournament;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class TournamentController extends Controller
{
    public function show(Tournament $tournament): Factory|View|Application
    {
        return view('chess.tournament.show', ['tournament' => $tournament]);
    }

    public function edit(Tournament $tournament): Factory|View|Application
    {
        return view('chess.tournament.edit', ['tournament' => $tournament]);
    }
}

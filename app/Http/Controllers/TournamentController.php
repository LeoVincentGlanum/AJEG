<?php

namespace App\Http\Controllers;

use App\Models\Tournament;

class TournamentController extends Controller
{
    public function edit(Tournament $tournament)
    {
        return view('tournament.edit', ['tournament' => $tournament]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Tournament;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class TournamentDartsController extends Controller
{
    public function show(Tournament $tournament): Factory|View|Application
    {
        return view('darts.tournament.show-darts', ['tournament' => $tournament]);

    }

    public function edit(Tournament $tournament): Factory|View|Application
    {

        return view('darts.tournament.edit-darts', ['tournament' => $tournament]);

    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Tournament;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class TournoisController extends Controller
{
    public function show($id): Factory|View|Application
    {
        $tournois = Tournament::query()->find($id);
        return view("tournament.show")->with(["tournois" => $tournois]);
    }
}

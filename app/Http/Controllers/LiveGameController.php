<?php

namespace App\Http\Controllers;

class LiveGameController extends Controller
{
    public function liveGame(){
        return view('liveGame.chess');
    }
}

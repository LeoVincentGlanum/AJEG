<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class ChessGame extends Game
{
    protected $table = 'games';

    protected static function booted()
    {
        static::creating(function (ChessGame $game) {
            $game->sport_id = 1;

             if ($game->label === "" || $game->label === null) {
                $nbGame = Game::all()->count() + 1;
                $game->label = Auth::user()->name . "'s Game " . $nbGame;
            }
        });
    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChessGame extends Game
{
    protected $table = 'games';

    protected static function booted()
    {
        static::creating(function (ChessGame $game) {
            $this->game->sport_id = 1;
        });
    }
}
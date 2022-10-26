<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GamePlayer extends Model
{
    use HasFactory;


    protected $fillable = [
        'game_id',
        'user_id',
        'results',
    ];

    public function game() {
        return $this->hasOne(Game::class, 'id', 'game_id');
    }

    public function user() {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}

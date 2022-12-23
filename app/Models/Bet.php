<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bet extends Model
{
    use HasFactory;

    protected $table = 'bets';

    protected $fillable = [
        'user_id',
        'game_id',
        'amount',
        'result',
        'created_at',
        'updated_at',
    ];
}

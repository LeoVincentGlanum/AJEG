<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DartScore extends Model
{
    use HasFactory;

    protected $table = 'dart_scores';

    protected $fillable = [
        'round_1',
        'round_2',
        'round_3',
        'round_4',
        'round_5',
        'score',
        'dart_game_id',
        'user_id'
    ];
}

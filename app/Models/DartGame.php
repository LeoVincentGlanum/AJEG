<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DartGame extends Model
{
    use HasFactory;

    protected $table = 'dart_games';

    protected $fillable = [
        'id',
    ];
}

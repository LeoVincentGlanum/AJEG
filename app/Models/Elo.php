<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Elo extends Model
{
    use HasFactory;

    protected $table = 'elo';

    protected $fillable = [
        'user_id',
        'sport_id',
        'elo'
    ];
}

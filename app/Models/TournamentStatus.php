<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TournamentStatus extends Model
{
    use HasFactory;

    protected $table = 'tournament_status';

    protected $fillable = [
        'label',
    ];
}

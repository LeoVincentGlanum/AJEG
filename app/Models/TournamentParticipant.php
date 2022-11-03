<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;

class TournamentParticipant extends Pivot
{
    public $incrementing = true;

    protected $table = 'tournament_participants';

    protected $fillable = [
        'tournament_id',
        'user_id',
        'wins',
        'paths',
        'draws',
        'losses',
    ];
}

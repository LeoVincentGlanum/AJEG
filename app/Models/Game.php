<?php

namespace App\Models;


use App\Enums\GameStatusEnum;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Game extends Model
{
    use HasFactory;
    use HasStates;

    protected $table = 'games';

    protected $fillable = [
        'status',
    ];

    protected $casts = [
        'status' => GameStatus::class
    ];


    public function gamePlayers(): HasMany
    {
        return $this->hasMany(GamePlayer::class, 'game_id', 'id');
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class,'game_players', 'game_id', 'user_id', 'id', 'id')->withPivot('result','color');
    }

    public function creator(): HasOne
    {
        return $this->hasOne(User::class,'id','created_by');
    }

}

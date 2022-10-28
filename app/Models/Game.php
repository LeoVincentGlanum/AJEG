<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Game extends Model
{
    use HasFactory;

    protected $table = 'games';

    protected $fillable = [
        'status',
    ];

    public function gamePlayers() 
    {
        return $this->hasMany(GamePlayer::class, 'game_id', 'id');
    }

    public function users() : BelongsToMany
    {
        return $this->belongsToMany(User::class,'game_players', 'game_id', 'user_id', 'id', 'id')->withPivot('result');
    }

    public function scopeGameResult($query, $value)
    {
      
        return ($query->first()->users()->where('result','like','%'.$value.'%'));
    }
}
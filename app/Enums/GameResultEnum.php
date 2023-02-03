<?php

namespace App\Enums;

use App\ModelStates\GamePlayerResultStates\Draw;
use App\ModelStates\GamePlayerResultStates\Loss;
use App\ModelStates\GamePlayerResultStates\Pat;
use App\ModelStates\GamePlayerResultStates\Win;

enum GameResultEnum:string
{
    case Win = 'win';
    case Loss = 'loss';
    case Pat = 'pat';
    case Draw = 'draw';

    public function tournamentPoint(): int
    {
        return GameResultEnum::getTournamentPoint($this);
    }

    public static function getTournamentPoint(self $value): int
    {
        return match ($value) {
            GameResultEnum::Win, GameResultEnum::Loss => 3,
            GameResultEnum::Pat => 1,
            GameResultEnum::Draw => 0,
        };
    }

    public static function toStateMachine(GameResultEnum $enum): string
    {
        return match ($enum) {
            self::Win => Win::class,
            self::Loss => Loss::class,
            self::Pat => Pat::class,
            self::Draw => Draw::class
        };

    }
}

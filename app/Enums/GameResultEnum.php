<?php

namespace App\Enums;

enum GameResultEnum:string
{
    case win = 'win';
    case lose = 'lose';
    case pat = 'pat';
    case nul = 'nul';

    public function tournamentPoint(): int
    {
        return GameResultEnum::getTournamentPoint($this);
    }

    public static function getTournamentPoint(self $value): int
    {
        return match ($value) {
            GameResultEnum::win, GameResultEnum::lose => 3,
            GameResultEnum::pat => 1,
            GameResultEnum::nul => 0,
        };
    }
}

<?php

namespace App\Enums;

use App\ModelStates\TournamentTypeStates\AllPlayAll;
use App\ModelStates\TournamentTypeStates\Championship;

enum TournamentTypeEnum:string
{
    case championship = 'Championship';
    case allPlayAll = 'All-Play-All';

        public static function mapWithStateMachine(string $value): array
    {
        return match($value) {
            self::championship->value => [Championship::class],
            self::allPlayAll->value => [AllPlayAll::class],
        };
    }
}

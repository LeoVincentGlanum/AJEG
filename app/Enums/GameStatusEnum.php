<?php

namespace App\Enums;

use App\ModelStates\GameStates\PlayersValidation;
use App\ModelStates\GameStates\ResultValidations;

enum GameStatusEnum: string
{
    case draft = "draft";
    case AskingForGame = 'playersvalidation';
    case gameAccepted = 'gameaccepted';
    case progress = 'in progress';
    case Ended = 'ended';

    public static function toStateMachine(GameStatusEnum $enum): string
    {
        return match ($enum) {
            self::AskingForGame => PlayersValidation::class,
            self::Ended => ResultValidations::class
        };

    }
}

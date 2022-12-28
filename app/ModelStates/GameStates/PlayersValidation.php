<?php

namespace App\ModelStates\GameStates;

class PlayersValidation extends \App\ModelStates\GameStatus
{
    public static string $name = 'playersvalidation';
    public function color(): string
    {
        // TODO: Implement color() method.
    }
    public function name(): string
    {
        return trans('player validation');
    }
}

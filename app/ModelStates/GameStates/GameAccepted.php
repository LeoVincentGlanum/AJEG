<?php

namespace App\ModelStates\GameStates;

class GameAccepted extends \App\ModelStates\GameStatus
{
    public static string $name = 'gameaccepted';
    public function color(): string
    {
        // TODO: Implement color() method.
    }

    public function name(): string
    {
        return trans('game accepted');
    }
}

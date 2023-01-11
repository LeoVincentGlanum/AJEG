<?php

namespace App\ModelStates\BetStates;

class WinBet extends \App\ModelStates\GameStatus
{
    public static string $name = 'Win';

    public function color(): string
    {
        // TODO: Implement color() method.
    }
    public function name(): string
    {
        return trans('Win');
    }
}

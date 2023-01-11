<?php

namespace App\ModelStates\BetStates;

class PendingBet extends \App\ModelStates\GameStatus
{
    public static string $name = 'Pending';

    public function color(): string
    {
        // TODO: Implement color() method.
    }
    public function name(): string
    {
        return trans('Pending');
    }
}

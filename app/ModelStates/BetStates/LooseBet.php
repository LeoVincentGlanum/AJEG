<?php

namespace App\ModelStates\BetStates;

class LooseBet extends \App\ModelStates\GameStatus
{
    public static string $name = 'Loose';

    public function color(): string
    {
        // TODO: Implement color() method.
    }
    public function name(): string
    {
        return trans('Loose');
    }
}

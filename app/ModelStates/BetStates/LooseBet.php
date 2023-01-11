<?php

namespace App\ModelStates\BetStates;

class LooseBet extends \App\ModelStates\BetState
{
    public static string $name = 'Lost';

    public function color(): string
    {
        // TODO: Implement color() method.
    }
    public function name(): string
    {
        return trans('Lost');
    }
}

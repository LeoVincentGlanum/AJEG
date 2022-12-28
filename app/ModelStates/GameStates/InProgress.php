<?php

namespace App\ModelStates\GameStates;

class InProgress extends \App\ModelStates\GameStatus
{

    public function color(): string
    {
        // TODO: Implement color() method.
    }

    public function name(): string
    {
        return trans('in progress');
    }
}

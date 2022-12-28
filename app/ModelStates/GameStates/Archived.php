<?php

namespace App\ModelStates\GameStates;

class Archived extends \App\ModelStates\GameStatus
{

    public function color(): string
    {
        // TODO: Implement color() method.
    }

    public function name(): string
    {
        return trans('archived');
    }


}

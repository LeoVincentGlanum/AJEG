<?php

namespace App\ModelStates\GameStates;

class PlayersValidation extends \App\ModelStates\GameStatus
{

    public function color(): string
    {
        // TODO: Implement color() method.
    }
    public function name(): string
    {
        return trans('player validation');
    }
}

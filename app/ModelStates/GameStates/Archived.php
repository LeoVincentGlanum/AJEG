<?php

namespace App\ModelStates\GameStates;

class Archived extends \App\ModelStates\GameStatus
{

    public static string $name = 'archived';
    public function color(): string
    {
        // TODO: Implement color() method.
    }

    public function name(): string
    {
        return trans('archived');
    }


}

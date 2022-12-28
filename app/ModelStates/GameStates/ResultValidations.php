<?php

namespace App\ModelStates\GameStates;

class ResultValidations extends \App\ModelStates\GameStatus
{
    public static string $name = 'resultvalidations';
    public function color(): string
    {
        // TODO: Implement color() method.
    }

    public function name(): string
    {
        return trans('result validation');
    }
}

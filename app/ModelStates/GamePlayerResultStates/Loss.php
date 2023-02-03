<?php

namespace App\ModelStates\GamePlayerResultStates;

class Loss extends \App\ModelStates\GamePlayerResultState
{

    public static string $name = 'loss';
    public function color(): string
    {
        return "red";
    }

    public function name() : string
    {
        return trans('loss');
    }
}

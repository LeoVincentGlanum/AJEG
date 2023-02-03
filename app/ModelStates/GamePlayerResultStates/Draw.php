<?php

namespace App\ModelStates\GamePlayerResultStates;

class Draw extends \App\ModelStates\GamePlayerResultState
{

    public static string $name = 'draw';
    public function color(): string
    {
        return "white";
    }

    public function name() : string
    {
        return trans('draw');
    }
}

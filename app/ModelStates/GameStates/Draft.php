<?php

namespace App\ModelStates\GameStates;

use App\ModelStates\GameStatus;

class Draft extends GameStatus
{

    public static string $name = 'draft';
    public function color(): string
    {
        return "gris";
    }

    public function name(): string
    {
        return trans('draft');
    }
}

<?php

namespace App\Enums;

use App\ModelStates\GamePlayerResultStates\Draw;
use App\ModelStates\GamePlayerResultStates\Loss;
use App\ModelStates\GamePlayerResultStates\Pat;
use App\ModelStates\GamePlayerResultStates\Win;

enum SportEnum:string
{
    case Chess = '1';
    case Darts = '2';
}

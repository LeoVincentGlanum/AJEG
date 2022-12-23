<?php

namespace App\Enums;

enum GameResultEnum:string
{
    case win = 'win';
    case lose = 'lose';
    case pat = 'path';
    case nul = 'null';
}

//Dans blade {{\App\Enums\GameResultEnum::pat}}

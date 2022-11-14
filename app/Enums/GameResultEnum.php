<?php

namespace App\Enums;

enum GameResultEnum:string
{
    case win = 'win';
    case lose = 'lose';
    case pat = 'pat';
    case nul = 'nul';
}

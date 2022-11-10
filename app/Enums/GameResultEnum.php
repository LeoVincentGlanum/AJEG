<?php

namespace App\Enums;

enum GameResultEnum:string
{
    case Win = 'win';
    case Lose = 'lose';
    case Pat = 'pat';
    case Nul = 'nul';
}

<?php

namespace App\Enums;

enum GameResult: string
{
    case Win = 'win';
    case Lose = 'lose';
    case Path = 'path';
    case Null = 'null';
}
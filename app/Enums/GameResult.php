<?php

namespace App\Enums;

enum GameResult: string
{
    case Win = 'win';
    case Lose = 'lose';
    case Null = 'null';
}
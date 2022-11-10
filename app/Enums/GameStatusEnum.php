<?php

namespace App\Enums;

enum GameStatusEnum:string
{
    case Progress = 'En cours';
    case Waiting = 'En attente';
    case Ended = 'Terminé';
}

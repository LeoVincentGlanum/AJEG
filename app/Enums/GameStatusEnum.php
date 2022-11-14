<?php

namespace App\Enums;

enum GameStatusEnum:string
{
    case progress = 'En cours';
    case waiting = 'En attente';
    case ended = 'Terminé';
}

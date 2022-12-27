<?php

namespace App\Enums;

enum TournamentStatusEnum:string
{
    case progress = 'En cours';
    case waiting = 'En attente';
    case ended = 'Terminé';
    case canceled = 'Annulé';
}

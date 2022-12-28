<?php

namespace App\Enums;

enum GameStatusEnum:string
{
    case draft = 'draft';
    case progress = 'progress';
    case waiting = 'waiting';
    case ended = 'resultvalidations';
}

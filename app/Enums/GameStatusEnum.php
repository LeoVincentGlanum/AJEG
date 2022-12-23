<?php

namespace App\Enums;

enum GameStatusEnum:string
{
    case draft = "draft";
    case waiting = 'waiting';
    case progress = 'in progress';
    case ended = 'ended';
}

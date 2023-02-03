<?php

namespace App\Http\Livewire\Chess\Game\Traits;

use App\Enums\GameResultEnum;
use App\ModelStates\GamePlayerResultStates\Draw;
use App\ModelStates\GamePlayerResultStates\Loss;
use App\ModelStates\GamePlayerResultStates\Pat;
use App\ModelStates\GamePlayerResultStates\Win;
use Illuminate\Support\Arr;

trait HasGameResultMapperChess
{
    protected function isWinSetResults($id): void
    {
        Arr::set($this->playerSelect, $id, Win::$name);
        Arr::set($this->playersResult, $id, Win::$name);
        foreach ($this->playersResult as $idPlayerResult => $player) {
            if ($idPlayerResult !== $id) {
                Arr::set($this->playerSelect, $idPlayerResult, Loss::$name);
                Arr::set($this->playersResult, $idPlayerResult, Loss::$name);
            }
        }
    }

    protected function isLoseSetResults($id): void
    {
        Arr::set($this->playerSelect, $id, Loss::$name);
        Arr::set($this->playersResult, $id, Loss::$name);
        foreach ($this->playersResult as $idPlayerResult => $player) {
            if ($idPlayerResult !== $id) {
                Arr::set($this->playerSelect, $idPlayerResult, Win::$name);
                Arr::set($this->playersResult, $idPlayerResult, Win::$name);
            }
        }
    }

    protected function isPatSetResults(): void
    {
        foreach ($this->playersResult as $idPlayerResult => $player) {
            Arr::set($this->playerSelect, $idPlayerResult, Pat::$name);
            Arr::set($this->playersResult, $idPlayerResult, Pat::$name);
        }
    }

    protected function isNulSetResults(): void
    {
        foreach ($this->playersResult as $idPlayerResult => $player) {
            Arr::set($this->playerSelect, $idPlayerResult, Draw::$name);
            Arr::set($this->playersResult, $idPlayerResult, Draw::$name);
        }
    }
}

<?php

namespace App\Http\Livewire\Chess\Game\Traits;

use App\Enums\GameResultEnum;
use Illuminate\Support\Arr;

trait HasGameResultMapperChess
{
    protected function isWinSetResults($id): void
    {
        Arr::set($this->playerSelect, $id, GameResultEnum::win->value);
        Arr::set($this->playersResult, $id, GameResultEnum::win->value);
        foreach ($this->playersResult as $idPlayerResult => $player) {
            if ($idPlayerResult !== $id) {
                Arr::set($this->playerSelect, $idPlayerResult, GameResultEnum::lose->value);
                Arr::set($this->playersResult, $idPlayerResult, GameResultEnum::lose->value);
            }
        }
    }

    protected function isLoseSetResults($id): void
    {
        Arr::set($this->playerSelect, $id, GameResultEnum::lose->value);
        Arr::set($this->playersResult, $id, GameResultEnum::lose->value);
        foreach ($this->playersResult as $idPlayerResult => $player) {
            if ($idPlayerResult !== $id) {
                Arr::set($this->playerSelect, $idPlayerResult, GameResultEnum::win->value);
                Arr::set($this->playersResult, $idPlayerResult, GameResultEnum::win->value);
            }
        }
    }

    protected function isPatSetResults(): void
    {
        foreach ($this->playersResult as $idPlayerResult => $player) {
            Arr::set($this->playerSelect, $idPlayerResult, GameResultEnum::pat->value);
            Arr::set($this->playersResult, $idPlayerResult, GameResultEnum::pat->value);
        }
    }

    protected function isNulSetResults(): void
    {
        foreach ($this->playersResult as $idPlayerResult => $player) {
            Arr::set($this->playerSelect, $idPlayerResult, GameResultEnum::nul->value);
            Arr::set($this->playersResult, $idPlayerResult, GameResultEnum::nul->value);
        }
    }
}

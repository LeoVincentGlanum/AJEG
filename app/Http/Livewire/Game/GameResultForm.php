<?php

namespace App\Http\Livewire\Game;

use App\Enums\GameResultEnum;
use App\Http\Livewire\Admin\ListGameType;
use App\Models\Game;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Log;
use LivewireUI\Modal\ModalComponent;

class GameResultForm extends ModalComponent
{
    public Game $game;
    public ?array $playerSelect = [];
    public array $playersResult = [];

    public function mount(int $id)
    {
        try {
            $this->game = Game::query()->find($id);

            foreach ($this->game->users as $player) {
                $this->playersResult = Arr::add($this->playersResult, $player->id, '');
            }

        } catch (\Exception $e) {
            Log::info();
        }

    }


    public function save()
    {
        $this->game->status = 'Terminé';

        try {
            foreach ($this->game->users as $user) {

                $user->pivot->result = Arr::get($this->playersResult, $user->id);
                $user->pivot->save();
            }
            $this->game->save();
            $this->dispatchBrowserEvent('toast', ['message' => 'Le resultat a bien été mis en validation', 'type' => 'success']);
        } catch (\Exeption $e) {
            $this->dispatchBrowserEvent('toast', ['message' => $e->getMessage(), 'type' => 'error']);
        }
        $this->closeModal();

    }

    /**
     * @param $id
     *
     * @return int|mixed|string
     */
    private function isWinSetResults($id) : mixed
    {
        Arr::set($this->playerSelect, $id, GameResultEnum::win->value);
        Arr::set($this->playersResult, $id, GameResultEnum::win->value);
        foreach ($this->playersResult as $idPlayerResult => $player) {
            if ($idPlayerResult !== $id) {
                Arr::set($this->playerSelect, $idPlayerResult, GameResultEnum::lose->value);
                Arr::set($this->playersResult, $idPlayerResult, GameResultEnum::lose->value);
            }
        }
        return $idPlayerResult;
    }

    /**
     * @param $id
     *
     * @return int|mixed|string
     */
    private function isLoseSetResults($id) : mixed
    {
        Arr::set($this->playerSelect, $id, GameResultEnum::lose->value);
        Arr::set($this->playersResult, $id, GameResultEnum::lose->value);
        foreach ($this->playersResult as $idPlayerResult => $player) {
            if ($idPlayerResult !== $id) {
                Arr::set($this->playerSelect, $idPlayerResult, GameResultEnum::win->value);
                Arr::set($this->playersResult, $idPlayerResult, GameResultEnum::win->value);
            }
        }
        return $idPlayerResult;
    }

    /**
     * @return int|string
     */
    private function isPatSetResults() : string|int
    {
        foreach ($this->playersResult as $idPlayerResult => $player) {
            Arr::set($this->playerSelect, $idPlayerResult, GameResultEnum::pat->value);
            Arr::set($this->playersResult, $idPlayerResult, GameResultEnum::pat->value);
        }
        return $idPlayerResult;
    }

    /**
     * @return void
     */
    private function isNulSetResults() : void
    {
        foreach ($this->playersResult as $idPlayerResult => $player) {
            Arr::set($this->playerSelect, $idPlayerResult, GameResultEnum::nul->value);
            Arr::set($this->playersResult, $idPlayerResult, GameResultEnum::nul->value);
        }
    }

    public function updatePlayerResult($id)
    {
        $lastPlayerSelect = $this->playerSelect[$id];

        if ($lastPlayerSelect === GameResultEnum::win->value) {
            $this->isWinSetResults($id);
        }

        if ($lastPlayerSelect === GameResultEnum::lose->value) {
            $this->isLoseSetResults($id);
        }

        if ($lastPlayerSelect === GameResultEnum::pat->value) {
           $this->isPatSetResults();
        }

        if ($lastPlayerSelect === GameResultEnum::nul->value) {
            $this->isNulSetResults();
        }
    }
    public function render()
    {
        return view('livewire.game.game-result-form');
    }
}

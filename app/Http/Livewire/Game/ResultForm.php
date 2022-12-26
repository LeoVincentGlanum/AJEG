<?php

namespace App\Http\Livewire\Game;

use App\Enums\GameResultEnum;
use App\Http\Livewire\Game\Traits\HasGameResultMapper;
use App\Http\Livewire\Traits\HasToast;
use App\Models\Game;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Log;
use LivewireUI\Modal\ModalComponent;

final class ResultForm extends ModalComponent
{
    use HasGameResultMapper, HasToast;

    public Game $game;

    public ?array $playerSelect = [];

    public array $playersResult = [];

    public function mount(int $id)
    {
        try {
            $this->game = Game::query()->find($id)->get();

            foreach ($this->game->users as $player) {
                $this->playersResult = Arr::add($this->playersResult, $player->id, '');
            }
        } catch (\Throwable $e) {
            Log::error($e->getMessage());
            $this->errorToast(__('An error occurred while retrieving data'));
        }
    }

    public function save()
    {
        try {
            $this->game->status = 'Terminé';
            foreach ($this->game->users as $user) {
                $user->pivot->result = Arr::get($this->playersResult, $user->id);
                $user->pivot->save();
            }
            $this->game->save();

            $this->successToast(__('The result has been put into validation'));
            $this->closeModal();
        } catch (\Throwable $e) {
            Log::error($e->getMessage() . $e->getTraceAsString());
            $this->errorToast(__('An error occurred while entering the result'));
        }
    }

    public function updatePlayerResult($id)
    {
        $lastPlayerSelect = $this->playerSelect[$id];

        match ($lastPlayerSelect) {
            GameResultEnum::win->value => $this->isWinSetResults($id),
            GameResultEnum::lose->value => $this->isLoseSetResults($id),
            GameResultEnum::pat->value => $this->isPatSetResults(),
            GameResultEnum::nul->value => $this->isNulSetResults()
        };
    }

    public function render()
    {
        return view('livewire.game.result-form');
    }
}

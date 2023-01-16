<?php

namespace App\Http\Livewire\Game;

use App\Enums\GameResultEnum;
use App\Http\Livewire\Game\Traits\HasBetMapper;
use App\ModelStates\GameStates\InProgress;
use App\ModelStates\GameStatus;
use App\ModelStates\GameStates\GameAccepted;
use App\ModelStates\PlayerRecognitionResultStates\Accepted;
use App\ModelStates\GameStates\ResultValidations;
use App\ModelStates\GameStates\PlayersValidation;
use App\Http\Livewire\Game\Traits\HasGameResultMapper;
use App\Http\Livewire\Traits\HasToast;
use App\Models\Game;
use Exception;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Log;
use LivewireUI\Modal\ModalComponent;

final class ResultForm extends ModalComponent
{
    use HasGameResultMapper, HasToast, HasBetMapper;

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
        } catch (\Throwable $e) {
            report($e);
            $this->errorToast('An error occurred while retrieving data');
        }
    }

    public function save()
    {
        try {
            if(!$this->game->status->equals(InProgress::class)) {
                throw new Exception('Status is not inProgress');
            }

            if ($this->game->status->equals(InProgress::class)) {
                $this->game->status->transitionTo(ResultValidations::class);
            }
            foreach ($this->game->gamePlayers as $player) {
                if ($player->user_id === auth()->id()){
                    $player->player_result_validation->transitionTo(Accepted::class);
                }
                $player->result = Arr::get($this->playersResult, $player->user_id);
                $player->save();
            }
            $this->game->save();

            $this->successToast('The result has been put into validation');
            $this->closeModal();
        } catch (\Throwable $e) {
            report($e);
            $this->errorToast('An error occurred while entering the result');
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

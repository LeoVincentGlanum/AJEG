<?php

namespace App\Http\Livewire\Darts\Game;

use App\Enums\GameResultEnum;
use App\Http\Livewire\Darts\Game\Traits\HasBetMapperDarts;
use App\Http\Livewire\Darts\Game\Traits\HasGameResultMapperDarts;
use App\Http\Livewire\Traits\HasToast;
use App\Models\Game;
use App\ModelStates\GameStates\InProgress;
use App\ModelStates\GameStates\ResultValidations;
use App\ModelStates\PlayerRecognitionResultStates\Accepted;
use Exception;
use Illuminate\Support\Arr;
use LivewireUI\Modal\ModalComponent;

final class ResultFormDarts extends ModalComponent
{
    use HasGameResultMapperDarts, HasToast, HasBetMapperDarts;

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

            if ($this->game->status == InProgress::$name) {
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
        return view('livewire.darts.game.result-form-darts');
    }
}

<?php

namespace App\Http\Livewire\Chess\Game;

use App\Enums\GameResultEnum;
use App\Http\Livewire\Chess\Game\Traits\HasBetMapperChess;
use App\Http\Livewire\Chess\Game\Traits\HasGameResultMapperChess;
use App\Http\Livewire\Game\Traits\HasBetMapper;
use App\Models\User;
use App\ModelStates\GamePlayerResultStates\Draw;
use App\ModelStates\GamePlayerResultStates\Loss;
use App\ModelStates\GamePlayerResultStates\Pat;
use App\ModelStates\GamePlayerResultStates\Win;
use App\ModelStates\GameStates\InProgress;
use App\ModelStates\GameStatus;
use App\ModelStates\GameStates\GameAccepted;
use App\ModelStates\PlayerRecognitionResultStates\Accepted;
use App\ModelStates\GameStates\ResultValidations;
use App\ModelStates\GameStates\PlayersValidation;
use App\Http\Livewire\Game\Traits\HasGameResultMapper;
use App\Http\Livewire\Traits\HasToast;
use App\Models\Game;
use App\Notifications\GameResultSendedNotification;
use App\Notifications\GameResultToAcceptNotification;
use Exception;
use Illuminate\Support\Arr;
use LivewireUI\Modal\ModalComponent;

final class ResultFormChess extends ModalComponent
{
    use HasGameResultMapperChess, HasToast, HasBetMapperChess;

    public ?Game $game = null;

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
                    User::find($player->user_id)->notify(new GameResultSendedNotification($this->game));
                }

                if($player->user_id !== auth()->id()){
                    User::find($player->user_id)->notify(new GameResultToAcceptNotification($this->game));
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
            Win::$name => $this->isWinSetResults($id),
            Loss::$name => $this->isLoseSetResults($id),
            Pat::$name => $this->isPatSetResults(),
            Draw::$name => $this->isNulSetResults()
        };
        $this->calculRank();
    }

    public function calculRank()
    {
        dd('calcul rank');
    }

    public function render()
    {
        return view('livewire.chess.game.result-form-chess');
    }
}

<?php

namespace App\Http\Livewire\Game;

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
                $this->playersResult = Arr::add($this->playersResult,  $player->id, '');
            }

        } catch (\Exception $e) {
            Log::info();
        }

    }


    public function save()
    {
        $this->game->status = 'Terminé';

        foreach ($this->game->users as $user) {

            $user->pivot->result = Arr::get($this->playersResult,$user->id);
            $user->pivot->save();
        }
        $this->game->save();
    }



    public function updatePlayerResult()
    {
        foreach ($this->playerSelect as $name => $result) {
            Arr::set($this->playersResult, $name, $result);
        }
    }


    public function render()
    {
        return view('livewire.game.game-result-form');
    }
}

<?php

namespace App\Http\Livewire\Admin;

use App\Models\GameType;
use LivewireUI\Modal\ModalComponent;

class GameTypeDelete extends ModalComponent
{
    public ?GameType $gameType;

    public function mount($id)
    {
        try {
            $this->gameType = GameType::query()->findOrFail($id);
        } catch (\Exception $e) {
            $this->gameType = null;
        }
    }

    public function delete()
    {
        $this->gameType->delete();

        $this->closeModalWithEvents([ListGameType::getName() => ['refreshListLine', [$this->gameType]]]);
    }

    public function render()
    {
        return view('livewire.admin.game-type-delete');
    }
}

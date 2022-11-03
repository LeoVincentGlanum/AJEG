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
        try {
            $this->gameType->delete();
            $this->dispatchBrowserEvent('toast', ['message' => 'Le type à bien été supprimé', 'type' => 'success']);
        } catch (\Exception $e) {
            $this->dispatchBrowserEvent('toast', ['message' => $e->getMessage(), 'type' => 'error']);
        }

        $this->closeModalWithEvents([ListGameType::getName() => ['refreshListGameType', [$this->gameType]]]);
    }

    public function render()
    {
        return view('livewire.admin.game-type-delete');
    }
}

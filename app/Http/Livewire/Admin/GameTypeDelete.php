<?php

namespace App\Http\Livewire\Admin;

use App\Http\Livewire\Traits\HasToast;
use App\Models\GameType;
use Illuminate\Support\Facades\Log;
use LivewireUI\Modal\ModalComponent;

class GameTypeDelete extends ModalComponent
{
    use HasToast;

    public ?GameType $gameType;

    public function mount($id)
    {
        try {
            $this->gameType = GameType::query()->findOrFail($id);
        } catch (\Throwable $e) {
            Log::error($e->getMessage());
            $this->gameType = null;
            $this->errorToast(__('An error occurred while retrieving the game'));
        }
    }

    public function delete()
    {
        try {
            $this->gameType->delete();
            $this->successToast(__('The type has been deleted'));
        } catch (\Throwable $e) {
            Log::error($e->getMessage());
            $this->errorToast(__('An error occurred while deleting the type'));
        }

        $this->closeModalWithEvents([ListGameType::getName() => ['refreshListGameType', [$this->gameType]]]);
    }

    public function render()
    {
        return view('livewire.admin.game-type-delete');
    }
}

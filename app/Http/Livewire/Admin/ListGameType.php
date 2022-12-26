<?php

namespace App\Http\Livewire\Admin;

use App\Http\Livewire\Traits\HasToast;
use App\Models\GameType;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class ListGameType extends Component
{
    use HasToast;

    public array|Collection $gameTypes;

    protected $listeners = ['refreshListGameType'];

    public function mount()
    {
        try {
            $this->gameTypes = GameType::all();
        } catch (\Throwable $e) {
            Log::error($e->getMessage());
            $this->gameTypes = [];
            $this->errorToast(__('An error occurred while retrieving the game types'));
        }
    }

    public function refreshListGameType()
    {
        try {
            $this->gameTypes = GameType::all();
        } catch (\Throwable $e) {
            Log::error($e->getMessage());
            $this->gameTypes = [];
            $this->errorToast(__('An error occurred while retrieving the game types'));
        }
    }

    public function render()
    {
        return view('livewire.admin.list-game-type');
    }
}

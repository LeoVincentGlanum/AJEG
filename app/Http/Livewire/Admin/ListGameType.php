<?php

namespace App\Http\Livewire\Admin;

use App\Models\GameType;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class ListGameType extends Component
{
    public Collection $gameTypes;

    protected $listeners = ['refreshListGameType'];

    public function mount()
    {
        $this->gameTypes = GameType::all();
    }

    public function refreshListGameType()
    {
        $this->gameTypes = GameType::all();
    }

    public function render()
    {
        return view('livewire.admin.list-game-type');
    }
}

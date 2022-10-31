<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\GameType;

class TypeGameShow extends Component
{
    public function mount()
    {
    }

    public function delete($id)
    {
        dd($id);
    }

    public function test()
    {
        dd('here');
    }

    public function render()
    {
        $allTypes = GameType::all();
        return view('livewire.type-game-show')->with(['typeGames' => $allTypes]);
    }
}

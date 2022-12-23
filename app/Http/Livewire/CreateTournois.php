<?php

namespace App\Http\Livewire;

use Livewire\Component;

class CreateTournois extends Component
{
    public function go(){
        return redirect('/tournament/');
    }

    public function render()
    {
        return view('livewire.create-tournois');
    }
}

<?php

namespace App\Http\Livewire\MyAccount;

use App\Models\User;
use Livewire\Component;

class MyAccount extends Component
{
    public $show = true;

    public function mount($id){
        $this->id = $id;
    }

    public function render()
    {
        $id = $this->id;
        $user = User::query()->where('id',$id)->first();

        return view('livewire.my-account.my-account', compact(
            'user'));
    }
}

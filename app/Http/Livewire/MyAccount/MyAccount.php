<?php

namespace App\Http\Livewire\MyAccount;

use App\Models\User;
use Livewire\Component;

class MyAccount extends Component
{
    public $page = 1;
    public $user;

    public function mount($id){
        $this->id = $id;
        $this->user = User::query()->where('id',$id)->first();
    }

    public function render()
    {
        return view('livewire.my-account.my-account');
    }
}

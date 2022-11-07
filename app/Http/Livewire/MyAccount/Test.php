<?php

namespace App\Http\Livewire\MyAccount;

use App\Models\User;
use Livewire\Component;

class Test extends Component
{
//    public function mount($id){
//        $this->id = $id;
//    }

    public function render()
    {
//        $id = $this->id;
//        $user = User::query()->where('id',$id)->first();

        return view('livewire.my-account.test');
//        , compact(
//            'user'));
    }
}

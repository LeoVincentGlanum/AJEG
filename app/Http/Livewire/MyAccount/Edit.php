<?php

namespace App\Http\Livewire\MyAccount;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Livewire\Component;

class Edit extends Component
{
    public string $name ;
    public string $email;
    public Model $user;

    public function mount($id){
        $this->id = $id;
        $this->user = User::query()->where('id',$id)->first();

        $this->name =  $this->user->name;
        $this->email = $this->user->email;
    }

    protected function rules()
    {
        return [
            'name' => 'required|string|max:255|unique:users'.$this->id.,
            'email' => 'required|string|email|max:255|unique:users'
        ];
    }


    public function abc()
    {
        $validatedData = $this->validate();

        $this->user->update($validatedData);

        session()->flash('message', 'User successfully updated.');
    }

    public function render()
    {
        return view('livewire.my-account.edit');
    }
}

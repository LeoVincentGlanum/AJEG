<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\GameType;

class TypeGameForm extends Component
{
    public $label;
    public $ratio;


      protected function rules()
    {
        return [
            'label' => 'required',
            'ratio' => 'numeric|min:1',
        ];
    }

     public function submit()
    {
        $validatedData = $this->validate();

        $newType = new GameType();

        $newType->label = $this->label;
        $newType->ratio = $this->ratio;
        $newType->save();

        session()->flash('message', 'Votre catégorie a été ajouté !');
        redirect('admin');
    }

    public function render()
    {
        return view('livewire.admin-type-game');
    }



}

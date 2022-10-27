<?php

namespace App\Http\Livewire;

use Livewire\Component;
use GuzzleHttp\Psr7\Request;

class TournoisForm extends Component
{
    public $name;
    public $cashprize_perso;

    protected $rules = [
        'name' => 'required',
        'cashprize_perso' => 'required',
    ];



    protected $messages = [
        'name.required' => 'Le nom du tournois est requis.',
        'cashprize_perso.required' => 'Vous devez renseigner un cashprize',
    ];

    public function render()
    {
        return view('livewire.tournois-form');
    }


     public function submit()
     {




         $this->validate();

          dd($this);
     }

}

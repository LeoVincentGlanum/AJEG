<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Tournois;
use Illuminate\Support\Facades\Auth;

class TournoisForm extends Component
{
    public $name;

    public $cashprize_perso;

    public $cashprize_modo;

    public $notification;

    protected $rules = [
        'name' => 'required',
        'cashprize_perso' => 'required',
        'cashprize_modo' => 'required',
    ];

    protected $messages = [
        'name.required' => 'Le nom du tournois est requis.',
        'cashprize_perso.required' => 'Vous devez renseigner le cashprize que vous offrez',
        'cashprize_perso.required' => 'Vous devez renseigner un cashprize offert par les modos',
    ];

     public function submit()
     {
         $this->validate();

         if ($this->notification === null){
             $this->notification = false;
         }


         $newTournois = new Tournois();
         $newTournois->name = $this->name;
         $newTournois->cashprize_perso = $this->cashprize_perso;
         $newTournois->cashprize_modo = $this->cashprize_perso;
         $newTournois->notification = $this->notification;
         $newTournois->user_id = Auth::id();
         $newTournois->save();


             session()->flash('message', 'Votre tournois à bien été créer, retrouver le <b><a href="'.route('tournament.show',['id' => $newTournois->id]).'">ici</a></b>');

            return redirect('dashboard');

//         $this->dispatchBrowserEvent('toast', ['message' => "coucou"]);
//
//
//        return redirect()->route('dashboard');

     }

    public function render()
    {
        return view('livewire.tournois-form');
    }
}

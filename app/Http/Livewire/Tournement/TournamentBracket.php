<?php

namespace App\Http\Livewire\Tournement;

use Livewire\Component;
use Core\TreeGenerator\BracketTournament;
class TournamentBracket extends Component
{

    public array $ArrayPlayer = ['léo','adrien','gaël','cyril','zac','florian','thomas','pierre'];

    public array $JsonBracket;
    public array $paramBracket ;


    public function mount()
    {
        $bracket = new BracketTournament($this->ArrayPlayer);
        $this->JsonBracket = $bracket->JsonBracket;
        $this->paramBracket = $bracket->paramBracket;
    }






    public function render()
    {
        return view('livewire.tournement.tournament-bracket');
    }
}

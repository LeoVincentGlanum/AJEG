<?php

namespace App\Http\Livewire\Game;

use App\Models\Game;
use Illuminate\Support\Facades\Log;
use LivewireUI\Modal\ModalComponent;

class GameResultForm extends ModalComponent
{
    public Game $game;

    public function mount(int $id)
    {
        try {
            $this->game = Game::query()->find($id);
    } catch (\Exception $e) {
        Log::info();
    }

    }

    public function setResult($value)
    {
        Log::info($value);
    }


//    protected array $rules = [
//        'gameType.label' => 'required|string|max:255',
//        'gameType.ratio' => 'required|regex:/^[0-9]+[.,]?[0-9]*$/i'
//    ];
//
//    protected $messages = [
//        'gameType.label.required' => 'Le champ label ne peut pas être vide.',
//        'gameType.label.string' => 'Le champ label doit être une chaine de caractères.',
//        'gameType.label.max' => 'Le champ label doit faire moins de 255 caractères.',
//        'gameType.ratio.required' => 'Le champ ratio ne peut pas être vide.',
//        'gameType.ratio.regex' => 'Le champ ratio ne peut contenir que les caractères suivant : 0-9/./,',
//    ];
//
//    public function mount($id)
//    {
//        $this->gameType = GameType::query()->find($id) ?? new GameType();
//
//        if ($this->gameType->id === null) {
//            $this->creation = true;
//        }
//    }
//
//    public function save()
//    {
//        $this->validate();
//
//        try {
//            $this->gameType->save();
//            $this->dispatchBrowserEvent('toast', ['message' => 'Le type à bien été sauvegardé', 'type' => 'success']);
//        } catch (\Exception $e) {
//            $this->dispatchBrowserEvent('toast', ['message' => $e->getMessage(), 'type' => 'error']);
//        }
//
//        $this->closeModalWithEvents([ListGameType::getName() => ['refreshListGameType', []]]);
//    }

    public function render()
    {
        return view('livewire.game.game-result-form');
    }
}

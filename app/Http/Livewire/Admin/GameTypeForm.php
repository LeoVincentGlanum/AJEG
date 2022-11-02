<?php

namespace App\Http\Livewire\Admin;

use App\Models\GameType;
use LivewireUI\Modal\ModalComponent;

class GameTypeForm extends ModalComponent
{
    public GameType $gameType;

    public bool $creation = false;

    protected array $rules = [
        'gameType.label' => 'required|string|max:255',
        'gameType.ratio' => 'required|regex:/^[0-9]+[.,]?[0-9]*$/i'
    ];

    protected $messages = [
        'gameType.label.required' => 'Le champ label ne peut pas être vide.',
        'gameType.label.string' => 'Le champ label doit être une chaine de caractères.',
        'gameType.label.max' => 'Le champ label doit faire moins de 255 caractères.',
        'gameType.ratio.required' => 'Le champ ratio ne peut pas être vide.',
        'gameType.ratio.regex' => 'Le champ ratio ne peut contenir que les caractères suivant : 0-9/./,',
    ];

    public function mount($id)
    {
        $this->gameType = GameType::query()->find($id) ?? new GameType();

        if ($this->gameType->id === null) {
            $this->creation = true;
        }
    }

    public function save()
    {
        $this->validate();

        $this->gameType->save();

        $this->closeModalWithEvents([ListGameType::getName() => ['refreshListGameType', []]]);
    }

    public function render()
    {
        return view('livewire.admin.game-type-form');
    }
}

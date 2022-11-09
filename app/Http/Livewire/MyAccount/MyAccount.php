<?php

namespace App\Http\Livewire\MyAccount;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Illuminate\Support\Arr;

class MyAccount extends Component
{
    public $tabs = [];

    public $tab;

    public $user;

//    protected $queryString = ['tab'];

    protected $listeners = ['changeTab'];


    public function mount($id)
    {
        $this->id = $id;
        $this->user = User::query()->where('id', $id)->first();
        $access = Auth::user()->id === (int)$id;
        $this->tabs = [
            [
                'name' => trans('stat'),
                'access' => true,
                'label' => trans('Stat'),
                'component' => 'my-account.dashboard',
            ],
            [
                'name' => trans('info'),
                'access' => $access,
                'label' => trans('mes informations'),
                'component' => 'my-account.edit',
            ],

        ];

        $this->changeTab($this->tab);



    }

    public function changeTab(?string $value)
    {
        if (!Arr::first($this->tabs,
            fn($tab) => Arr::get($tab, 'name') === $value
            , false)
        ) {
            $this->firstTab();

            return;
        }

        $this->tab = $value;
    }

    public function firstTab()
    {
        $this->tab = Arr::get(Arr::first($this->tabs), 'name');
    }

    public function render()
    {
        return view('livewire.my-account.my-account');
    }
}

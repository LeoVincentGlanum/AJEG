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
                'label' => trans('Statistiques'),
                'component' => 'my-account.dashboard',
                'svg' => '<svg class="mr-3 h-6 w-6 flex-shrink-0 text-indigo-300"
                                     xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                     stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25"/>
                                </svg>'
            ],
            [
                'name' => trans('info'),
                'access' => $access,
                'label' => trans('Mes informations'),
                'component' => 'my-account.edit',
                'svg' => '<svg class="mr-4 h-6 w-6 flex-shrink-0 text-indigo-300" xmlns="http://www.w3.org/2000/svg"
                                 fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                 aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M2.25 12.75V12A2.25 2.25 0 014.5 9.75h15A2.25 2.25 0 0121.75 12v.75m-8.69-6.44l-2.12-2.12a1.5 1.5 0 00-1.061-.44H4.5A2.25 2.25 0 002.25 6v12a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18V9a2.25 2.25 0 00-2.25-2.25h-5.379a1.5 1.5 0 01-1.06-.44z"/>
                            </svg>'
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

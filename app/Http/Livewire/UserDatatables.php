<?php
   
namespace App\Http\Livewire;
    
use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Str;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\NumberColumn;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\BooleanColumn;

use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
   
class UserDatatables extends LivewireDatatable
{
    public $model = User::class;
    public $selected_id,$name;
    public $updateMode = false;


    protected $rules = [
        'name' => 'required',
    ];
    /**
     * Write code on Method
     *
     * @return response()
     */

    public function columns()
    {
        return [
            NumberColumn::name('id')
                ->label('ID')
                ->sortBy('id'),
   
            Column::name('name')
                ->label('Nom')
                ->filterable()
                ->sortBy('name'),

            Column::name('email')
                ->sortBy('email')
                ->filterable(),
   
            DateColumn::name('created_at')
                ->label('Date de création')
                ->filterable(),

        ];
    }
}
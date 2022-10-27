<?php
   
namespace App\Http\Livewire;
    
use Livewire\Component;
use App\Models\Game;
use App\Models\User;

use Illuminate\Support\Str;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\NumberColumn;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\BooleanColumn;

use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
   
class GamesHistoryDatatables extends LivewireDatatable
{
    public $model = Game::class;
    public $selected_id;
    public $updateMode = false;

    public function columns()
    {
        return [
            NumberColumn::name('id')
                ->label('ID')
                ->sortBy('id'),

            Column::name('user_white.name')
                ->label('Joueur 1')
                ->filterable(),

            Column::name('user_black.name')
                ->label('Joueur 2')
                ->filterable(),

              //  Column::name('perdant.user.name')
                //->label('Joueur 2')
               // ->filterable(),

            // Column::name('gamePlayer.user_id')
            //    ->label('Résultat')
            //    ->group('group1')
            //    ->filterable(),

            Column::name('gamePlayer.results')
                ->label('Résultat')
                ->filterable(),

            // Column::raw('')
            //     ->label('Computed (raw SQL)')
            //     ->filterable(),

                //Column::callback(['id', 'planet.name'], function ($id, $planetName) {
                    //      dd($planetName);
            //  })->label('Résultat'),

            DateColumn::name('created_at')
                ->label('Date de création')
                ->filterable(),
        ];
    }
}
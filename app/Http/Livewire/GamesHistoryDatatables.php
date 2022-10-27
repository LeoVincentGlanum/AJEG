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

            Column::name('users.name')
               ->label('Joueurs')
               ->filterable(),

            // Column::name('gamePlayer.results')
            //     ->label('Résultat')
            //     ->filterable(),

            // Column::raw('')
            //     ->label('Computed (raw SQL)')
            //     ->filterable(),

            // Column::raw('CONCAT(gamePlayer.user_id, " a ", gamePlayer.results ) AS game')
            //     ->label('Computed (raw SQL)')
            //     ->filterable(),

            // Column::callback('gamePlayer.user_id', 'gamePlayer.results')
            //     ->label('Go to bed')
            //     ->hide(),

                //Column::callback(['id', 'planet.name'], function ($id, $planetName) {
                    //      dd($planetName);
            //  })->label('Résultat'),

            DateColumn::name('created_at')
                ->label('Date de création')
                ->filterable(),
        ];
    }
}
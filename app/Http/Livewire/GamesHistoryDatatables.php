<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Game;
use App\Models\User;
use App\Models\GamePlayer;


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

            Column::name('status')
                ->label('Statut')
                ->filterable(['En attente', 'En cours', 'Terminé']),

            Column::name('users.name')
               ->label('Joueurs')
               ->filterable()
               ->linkTo('user'),

            Column::name('gamePlayers.result')
                ->label('Joueurs')
                ->filterable(),

            Column::callback('id', 'gameResult')
                ->label('Résultat')
                ->searchable(),

//              ->filterable()
//              ->filterOn(dd($this, GamePlayer::query()->select('user_id','result')->get())),

            DateColumn::name('created_at')
                ->label('Date de création')
                ->filterable(),
        ];

    }

    public function gameResult($id)
    {
        if (!$id)
        {
            return "-";
        }

        $game = Game::query()->where('id', $id)->first()->users()->get();

        foreach ($game as $player) {
            if ($player->pivot->result === 'win')
            {
                return $player->name." ".$player->pivot->result;

            } elseif ($player->pivot->result === 'null')
            {
                return "Match null";

            } elseif ($player->pivot->result === 'path')
            {
                return "Path";
            }
        }

        return "-";
    }
}
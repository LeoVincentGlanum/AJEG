<?php

namespace App\Http\Livewire\Darts\OnlineGame;

use App\Models\Record;
use Illuminate\Http\Request;

use Livewire\Component;

class Scores extends Component
{
    public array $scores = [
        ['name' => '', 'score' => '']
    ];

    public $newNom;

    public array $rounds = [
        'round1',
        'round2',
        'round3',
        'round4',
        'round5',
    ];

    public function addRow()
    {
        $this->scores[] = [
            'name' => '',
            'round1' => '',
            'round2' => '',
            'round3' => '',
            'round4' => '',
            'round5' => '',
            'score' => '',
        ];
        $this->newNom = '';
    }

    public function save(Request $request)
    {
        foreach ($request->input('serverMemo.data.scores') as $input) {

            $topGame = Record::query()->where('type', 'TopGame')->firstOrFail();
            if ($input['score'] > $topGame->score) {
                $topGame->score = $input['score'];
                $topGame->name = $input['name'];
                $topGame->save();
            }

            $topRound = Record::query()->where('type', 'TopRound')->firstOrFail();
            foreach ($this->rounds as $round) {
                if ($input[$round] > $topRound->score) {
                    $topRound->score = $input[$round];
                    $topRound->name = $input['name'];
                    $topRound->save();
                }
            }

            $worstRound = Record::query()->where('type', 'WorstRound')->firstOrFail();
            foreach ($this->rounds as $round) {
                if ($input[$round] < $worstRound->score) {
                    $worstRound->score = $input[$round];
                    $worstRound->name = $input['name'];
                    $worstRound->save();
                }
            }

            $worstGame = Record::query()->where('type', 'WorstGame')->firstOrFail();
            if ($input['score'] < $worstGame->score) {
                $worstGame->score = $input['score'];
                $worstGame->name = $input['name'];
                $worstGame->save();
            }
        }
    }

    public function render()
    {
        return view('livewire.darts.onlineGame.scores');
    }
}

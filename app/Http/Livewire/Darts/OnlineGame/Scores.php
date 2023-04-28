<?php

namespace App\Http\Livewire\Darts\OnlineGame;

use App\Models\Record;
use Illuminate\Http\Request;

use Livewire\Component;

class Scores extends Component
{
    public array $scores;
    public array $rounds = [
        'round1',
        'round2',
        'round3',
        'round4',
        'round5',
    ];
    public function mount()
    {
        $this->scores = [
            [
                'name' => '',
                'round1' => '',
                'round2' => '',
                'round3' => '',
                'round4' => '',
                'round5' => '',
                'score' => '',
            ]
        ];
    }

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
    }

    public function updated($index)
    {
        preg_match('/\d+/', $index, $matches1);
        $indexScore = $matches1[0];

        $partyPerPlayer = $this->scores[$indexScore];
        $totalScorePlayer = (int)$partyPerPlayer['round1']+(int)$partyPerPlayer['round2']+(int)$partyPerPlayer['round3']+(int)$partyPerPlayer['round4']+(int)$partyPerPlayer['round5'];
        $partyPerPlayer['score'] = $totalScorePlayer;

        $this->scores[$indexScore] = $partyPerPlayer;
    }

    public function save(Request $request)
    {
        $allInputs = $request->input('serverMemo.data.scores');

        foreach ($allInputs as $input) {
            $topGame = Record::query()->where('type', 'TopGame')->firstOrFail();
            if ($input['score'] > $topGame->score) {
                $topGame->score = $input['score'];
                $topGame->name = $input['name'];
                $topGame->save();
            }

            $worstGame = Record::query()->where('type', 'WorstGame')->firstOrFail();
            if ($input['score'] < $worstGame->score) {
                $worstGame->score = $input['score'];
                $worstGame->name = $input['name'];
                $worstGame->save();
            }

            $topRound = Record::query()->where('type', 'TopRound')->firstOrFail();
            $worstRound = Record::query()->where('type', 'WorstRound')->firstOrFail();
            foreach ($this->rounds as $round) {
                if ((int)$input[$round] > $topRound->score) {
                    $topRound->score = $input[$round];
                    $topRound->name = $input['name'];
                    $topRound->save();
                }

                if ($input[$round] < $worstRound->score) {
                    $worstRound->score = $input[$round];
                    $worstRound->name = $input['name'];
                    $worstRound->save();
                }
            }
        }
        $this->emit('recordsChanged');

        $this->scores = [
            [
                'name' => '',
                'round1' => '',
                'round2' => '',
                'round3' => '',
                'round4' => '',
                'round5' => '',
                'score' => '',
            ]
        ];
    }

    public function render()
    {
        return view('livewire.darts.onlineGame.scores');
    }
}

<?php

namespace App\Http\Livewire\Darts\OnlineGame;

use App\Http\Livewire\Traits\HasToast;
use App\Models\Record;
use Illuminate\Http\Request;

use Livewire\Component;

class Scores extends Component
{
    use HasToast;

    public array $scores;

//    protected $listeners = ['updateScore'];

    public int $score;
    public int $count;

    public array $rounds;

    public function mount()
    {
        $this->rounds = [
            'round1',
            'round2',
            'round3',
            'round4',
            'round5',
        ];
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

    public function init_count()
    {
        $this->count = 3;
    }

    public function decrement_count()
    {
        $this->count--;
    }

    public function removeRow($index)
    {
        unset($this->scores[$index]);
    }

    public function updateScore($data)
    {
    }

    public function addThrowToRound($score)
    {
    }

    public function roundScore($player, $round, $score = 0)
    {
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
        $totalScorePlayer = (int)$partyPerPlayer['round1'] + (int)$partyPerPlayer['round2'] + (int)$partyPerPlayer['round3'] + (int)$partyPerPlayer['round4'] + (int)$partyPerPlayer['round5'];
        $partyPerPlayer['score'] = $totalScorePlayer;

        $this->scores[$indexScore] = $partyPerPlayer;
    }

    public function save(Request $request)
    {
        $allInputs = $request->input('serverMemo.data.scores');
        $delay = 0;
        foreach ($allInputs as $input) {
            $topGame = Record::query()->where('type', 'TopGame')->firstOrFail();
            if ($input['score'] > $topGame->score) {
                $topGame->score = $input['score'];
                $topGame->name = $input['name'];
                $topGame->save();

                $this->recordToast($input['name'] . ' a battu le record de la meilleure partie avec :' . $input['score'], $delay);
                $delay += 500;
            }

            $worstGame = Record::query()->where('type', 'WorstGame')->firstOrFail();
            if ($input['score'] < $worstGame->score) {
                $worstGame->score = $input['score'];
                $worstGame->name = $input['name'];
                $worstGame->save();

                $this->recordToast($input['name'] . ' a battu le record de la pire partie avec :' . $input['score'], $delay);
                $delay += 500;
            }

            $topRound = Record::query()->where('type', 'TopRound')->firstOrFail();
            $worstRound = Record::query()->where('type', 'WorstRound')->firstOrFail();
            foreach ($this->rounds as $round) {
                if ((int)$input[$round] > $topRound->score) {
                    $topRound->score = $input[$round];
                    $topRound->name = $input['name'];
                    $topRound->save();

                    $this->recordToast($input['name'] . ' a battu le record de la meilleure manche avec :' . $input['score'], $delay);
                    $delay += 500;
                }

                if ($input[$round] < $worstRound->score) {
                    $worstRound->score = $input[$round];
                    $worstRound->name = $input['name'];
                    $worstRound->save();

                    $this->recordToast($input['name'] . ' a battu le record de la pire manche avec :' . $input['score'], $delay);
                    $delay += 500;
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

<?php

namespace App\Http\Livewire\Darts\OnlineGame;

use App\Http\Livewire\Traits\HasToast;
use App\Models\DartGame;
use App\Models\DartScore;
use App\Models\Record;
use App\Models\User;
use Illuminate\Http\Request;

use Livewire\Component;

class Scores extends Component
{
    use HasToast;

    public array $scores;
    public array $users;
    public int $score;
    public int $count;
    public array $rounds;
    public $index;


    public function mount()
    {
        $this->users = User::query()->get()->toArray();
        $this->scores = [
            [
                'name' => '',
                'round1' => [
                    'name' => "round1",
                    'throw_count' => 3,
                    'round_score' => "",
                ],
                'round2' => [
                    'name' => "round2",
                    'throw_count' => 3,
                    'round_score' => "",
                ],
                'round3' => [
                    'name' => "round3",
                    'throw_count' => 3,
                    'round_score' => "",
                ],
                'round4' => [
                    'name' => "round4",
                    'throw_count' => 3,
                    'round_score' => "",
                ],
                'round5' => [
                    'name' => "round5",
                    'throw_count' => 3,
                    'round_score' => "",
                ],
                'score' => '',
            ]
        ];
        $this->index = 0;

        $this->rounds = [
            'round1' => [
                'name' => "round1",
                'throw_count' => 3,
                'round_score' => $this->scores[$this->index]['round1']['round_score'] ?? "",
            ],
            'round2' => [
                'name' => "round2",
                'throw_count' => 3,
                'round_score' => $this->scores[$this->index]['round2']['round_score'] ?? "",
            ],
            'round3' => [
                'name' => "round3",
                'throw_count' => 3,
                'round_score' => $this->scores[$this->index]['round3']['round_score'] ?? "",
            ],
            'round4' => [
                'name' => "round4",
                'throw_count' => 3,
                'round_score' => $this->scores[$this->index]['round4']['round_score'] ?? "",
            ],
            'round5' => [
                'name' => "round5",
                'throw_count' => 3,
                'round_score' => $this->scores[$this->index]['round5']['round_score'] ?? "",
            ],
        ];
    }

    protected function rules(): array
    {
        $array = [];

        foreach ($this->scores as $index => $score) {
            $array['scores.' . $index . '.name'] = 'required';
            $array['scores.' . $index . '.round1'] = 'required';
            $array['scores.' . $index . '.round2'] = 'required';
            $array['scores.' . $index . '.round3'] = 'required';
            $array['scores.' . $index . '.round4'] = 'required';
            $array['scores.' . $index . '.round5'] = 'required';
            $array['scores.' . $index . '.score'] = 'required';
        }

        return $array;
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

    public function addRow()
    {
        $this->scores[] = [
            'name' => '',
            'round1' => [
                'name' => "round1",
                'throw_count' => 3,
                'round_score' => "",
            ],
            'round2' => [
                'name' => "round2",
                'throw_count' => 3,
                'round_score' => "",
            ],
            'round3' => [
                'name' => "round3",
                'throw_count' => 3,
                'round_score' => "",
            ],
            'round4' => [
                'name' => "round4",
                'throw_count' => 3,
                'round_score' => "",
            ],
            'round5' => [
                'name' => "round5",
                'throw_count' => 3,
                'round_score' => "",
            ],
            'score' => '',
        ];
    }

public function updated($index, $userId)
{
    preg_match('/\d+/', $index, $matches1);
    $indexScore = $matches1[0];
    $partyPerPlayer = $this->scores[$indexScore];

    $rounds = ['round1', 'round2', 'round3', 'round4', 'round5'];
    $totalScorePlayer = 0;

    foreach ($rounds as $round) {
        $totalScorePlayer += (int)$partyPerPlayer[$round]['round_score'];
    }

    $partyPerPlayer['score'] = $totalScorePlayer;
    $this->scores[$indexScore] = $partyPerPlayer;
}


    public function save(Request $request)
    {
        $this->validate();

        try {
            $dartGame = DartGame::query()->create();
            $allInputs = $request->input('serverMemo.data.scores');
            $delay = 0;
            foreach ($allInputs as $input) {
                DartScore::query()->create([
                    'round_1' => $input['round1']['round_score'],
                    'round_2' => $input['round2']['round_score'],
                    'round_3' => $input['round3']['round_score'],
                    'round_4' => $input['round4']['round_score'],
                    'round_5' => $input['round5']['round_score'],
                    'score' => $input['score'],
                    'dart_game_id' => $dartGame->id,
                    'user_id' => $input['name'],
                ]);

                $topGame = Record::query()->where('type', 'TopGame')->firstOrFail();
                if ($input['score'] > $topGame->score) {
                    $topGame->score = $input['score'];
                    $topGame->user_id = $input['name'];
                    $topGame->save();
                }

                $worstGame = Record::query()->where('type', 'WorstGame')->firstOrFail();
                if ($input['score'] < $worstGame->score) {
                    $worstGame->score = $input['score'];
                    $worstGame->user_id = $input['name'];
                    $worstGame->save();
                }

                $topRound = Record::query()->where('type', 'TopRound')->firstOrFail();
                $worstRound = Record::query()->where('type', 'WorstRound')->firstOrFail();
                foreach ($this->rounds as $round) {
                    if ((int)$input[$round['name']]['round_score'] > $topRound->score) {
                        $topRound->score = (int)$input[$round['name']]['round_score'];
                        $topRound->user_id = $input['name'];
                        $topRound->save();
                    }

                    if ((int)$input[$round['name']]['round_score'] < $worstRound->score) {
                        $worstRound->score = (int)$input[$round['name']]['round_score'];
                        $worstRound->user_id = $input['name'];
                        $worstRound->save();
                    }
                }
            }
            $this->emit('recordsChanged');

            $this->scores = [
                [
                    'name' => '',
                    'round1' => [
                        'name' => "round1",
                        'throw_count' => 3,
                        'round_score' => "",
                    ],
                    'round2' => [
                        'name' => "round2",
                        'throw_count' => 3,
                        'round_score' => "",
                    ],
                    'round3' => [
                        'name' => "round3",
                        'throw_count' => 3,
                        'round_score' => "",
                    ],
                    'round4' => [
                        'name' => "round4",
                        'throw_count' => 3,
                        'round_score' => "",
                    ],
                    'round5' => [
                        'name' => "round5",
                        'throw_count' => 3,
                        'round_score' => "",
                    ],
                    'score' => '',
                ]
            ];
        } catch (\Exception $e) {
            $this->errorToast($e);
        }
    }

    public function render()
    {
        return view('livewire.darts.onlineGame.scores');
    }
}

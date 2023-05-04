<?php

namespace Database\Seeders;

use App\Models\Record;
use Illuminate\Database\Seeder;

class RecordsTableSeeder extends Seeder
{
    public function run()
    {
        Record::create(['user_id' => 1, 'type' => 'TopGame', 'score' =>297]);
        Record::create(['user_id' => 1, 'type' => 'WorstGame', 'score' =>-128]);
        Record::create(['user_id' => 1, 'type' => 'TopRound', 'score' =>142]);
        Record::create(['user_id' => 1, 'type' => 'WorstRound', 'score' =>-30]);
    }
}

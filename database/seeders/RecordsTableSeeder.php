<?php

namespace Database\Seeders;

use App\Models\Record;
use Illuminate\Database\Seeder;

class RecordsTableSeeder extends Seeder
{
    public function run()
    {
        Record::create(['user_id' => 6, 'type' => 'TopGame', 'score' =>297]);
        Record::create(['user_id' => 9, 'type' => 'WorstGame', 'score' =>-128]);
        Record::create(['user_id' => 7, 'type' => 'TopRound', 'score' =>142]);
        Record::create(['user_id' => 6, 'type' => 'WorstRound', 'score' =>-30]);
    }
}

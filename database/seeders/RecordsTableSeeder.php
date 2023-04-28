<?php

namespace Database\Seeders;

use App\Models\Record;
use Illuminate\Database\Seeder;

class RecordsTableSeeder extends Seeder
{
    public function run()
    {
        Record::create(['name' => 'Ella', 'type' => 'TopGame', 'score' =>297]);
        Record::create(['name' => 'Pierre', 'type' => 'WorstGame', 'score' =>-128]);
        Record::create(['name' => 'Tomo', 'type' => 'TopRound', 'score' =>142]);
        Record::create(['name' => 'Ella', 'type' => 'WorstRound', 'score' =>-30]);
    }
}

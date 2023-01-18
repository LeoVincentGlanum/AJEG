<?php

namespace Database\Seeders;

use App\Models\GameType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory()->testUser()->create();
        \App\Models\User::factory(100)->create();
//        \App\Models\Game::factory(50)->create();
//        \App\Models\GamePlayer::factory(100)->create();
        \App\Models\Transaction::factory(20)->create();
        DB::table('game_types')->insert([
            'label' => 'standard',
            'ratio' => 1.0,
        ]);
        DB::table('sports')->insert([
            'label' => 'Échecs',
        ]);
        DB::table('sports')->insert([
            'label' => 'Fléchettes',
        ]);

    }
}

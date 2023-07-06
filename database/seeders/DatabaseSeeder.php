<?php

namespace Database\Seeders;

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
        DB::table('ajeg_game_types')->insert([
            'label' => 'standard',
            'ratio' => 1.0,
        ]);

        DB::table('ajeg_sports')->insert([
            'label' => 'Échecs',
        ]);
        DB::table('ajeg_sports')->insert([
            'label' => 'Fléchettes',
        ]);

        $this->call([
            UserSeeder::class,
//            GameSeeder::class,
//            GamePlayerSeeder::class,
//            BetSeeder::class,
//            TournamentSeeder::class,
//            TournamentParticipantSeeder::class,
//            RecordsTableSeeder::class,
        ]);
    }
}

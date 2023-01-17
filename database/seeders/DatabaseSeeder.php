<?php

namespace Database\Seeders;

use App\Models\GameType;
use App\Models\Transaction;
use App\Models\User;
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
        $this->call([
            UserSeeder::class,
            GameSeeder::class,
            GamePlayerSeeder::class
        ]);

        DB::table('game_types')->insert([
            'label' => 'standard',
            'ratio' => 1.0,
        ]);
    }
}

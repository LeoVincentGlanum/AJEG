<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

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
        \App\Models\User::factory(10)->create();
        \App\Models\Game::factory(10)->create();
        \App\Models\GamePlayer::factory(100)->create();
        \App\Models\Transaction::factory(20)->create();
    }
}

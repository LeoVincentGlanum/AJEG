<?php

namespace Database\Seeders;

use App\Models\Transaction;
use App\Models\User;
use Illuminate\Database\Seeder;
class UserSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory(1)->admin()->create();

        User::factory()
            ->count(50)
            ->has(
                Transaction::factory()
                ->count(4)
            )
            ->create();
    }
}

<?php

namespace Database\Seeders;

use App\Models\UserDetail;
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
        \App\Models\User::factory(['email' => 'user@test.com'])
            ->has(UserDetail::factory(), 'detail')
            ->create();

        \App\Models\User::factory(10)
            ->has(UserDetail::factory(), 'detail')
            ->create();
    }
}

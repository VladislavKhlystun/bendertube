<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::query()->firstOrCreate([
            'name' => 'Black Jack',
            'email' => 'blackjack@gmail.com',
            'password' => bcrypt('hooker'),
            ]);

        User::query()->firstOrCreate([
            'name' => 'ADMIN',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('hooker'),
            'role' => '2',
            ]);
    }
}

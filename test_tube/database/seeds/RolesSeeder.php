<?php

use Illuminate\Database\Seeder;
use App\Roles;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Roles::query()->firstOrCreate([
            'role' => 'admin',
        ]);

        Roles::query()->firstOrCreate([
            'role' => 'user',
        ]);
    }
}
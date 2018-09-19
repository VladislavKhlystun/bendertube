<?php

use Illuminate\Database\Seeder;
use App\Category;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::query()->firstOrCreate([
            'title' => 'Common'
        ]);

        Category::query()->firstOrCreate([
            'title' => 'Animals'
        ]);

        Category::query()->firstOrCreate([
            'title' => 'Auto'
        ]);

        Category::query()->firstOrCreate([
            'title' => 'Animals'
        ]);

        Category::query()->firstOrCreate([
            'title' => 'Entertainment'
        ]);

        Category::query()->firstOrCreate([
            'title' => 'Sport'
        ]); 

        Category::query()->firstOrCreate([
            'title' => 'Music'
        ]);

        Category::query()->firstOrCreate([
            'title' => 'Games'
        ]);

        Category::query()->firstOrCreate([
            'title' => 'Comedy'
        ]);
    }
}

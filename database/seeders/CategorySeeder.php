<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // for tests
        //Category::factory()->count(50)->make();

        // work
        Category::truncate();
        Category::factory()->count(50)->create();
    }
}

<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::factory()->createMany([
            ['category_type' => 0],
            ['category_type' => 1],
            ['category_type' => 2],
            ['category_type' => 3],
            ['category_type' => 4],
            ['category_type' => 5],
            ['category_type' => 6],
            ['category_type' => 7],
            ['category_type' => 8],
            ['category_type' => 9],
            ['category_type' => 10],
            ['category_type' => 11],
            ['category_type' => 12],
            ['category_type' => 13],
            ['category_type' => 14],
            ['category_type' => 15],
            ['category_type' => 16],
            ['category_type' => 17],
            ]
        );

    }
}

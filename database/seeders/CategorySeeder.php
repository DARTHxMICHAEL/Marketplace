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
        $categories = [
            ['name' => 'Electronics'],
            ['name' => 'Furniture'],
            ['name' => 'Clothing'],
            ['name' => 'Vehicles'],
            ['name' => 'Real Estate'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}

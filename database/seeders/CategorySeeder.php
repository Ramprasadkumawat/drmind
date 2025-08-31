<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::truncate();

        // Parent Categories
        $parentCategories = [
            ['name' => 'AFC Dr\'s Food', 'type' => 'physical', 'image_path' => 'categories/food.jpg'],
            ['name' => 'Herbal Remedies', 'type' => 'physical', 'image_path' => 'categories/herbal.jpg'],
            ['name' => 'Life Education', 'type' => 'service', 'image_path' => 'categories/education.jpg'],
            ['name' => 'E-Products', 'type' => 'e-product', 'image_path' => 'categories/ebook.jpg'],
        ];

        foreach ($parentCategories as $categoryData) {
            Category::create([
                'name' => $categoryData['name'],
                'slug' => Str::slug($categoryData['name']),
                'type' => $categoryData['type'],
                'parent_id' => 0, // 0 for parent categories
                'status' => 1,
                'image_path' => $categoryData['image_path'],
            ]);
        }

        // Subcategories for AFC Dr's Food
        $afcFood = Category::where('name', 'AFC Dr\'s Food')->first();
        if ($afcFood) {
            Category::create([
                'name' => 'Healthy Snacks',
                'slug' => Str::slug('Healthy Snacks'),
                'type' => 'physical',
                'parent_id' => $afcFood->id,
                'status' => 1,
                'image_path' => 'categories/snacks.jpg',
            ]);
            Category::create([
                'name' => 'Organic Meals',
                'slug' => Str::slug('Organic Meals'),
                'type' => 'physical',
                'parent_id' => $afcFood->id,
                'status' => 1,
                'image_path' => 'categories/meals.jpg',
            ]);
        }

        // Subcategories for Herbal Remedies
        $herbalRemedies = Category::where('name', 'Herbal Remedies')->first();
        if ($herbalRemedies) {
            Category::create([
                'name' => 'Immune Boosters',
                'slug' => Str::slug('Immune Boosters'),
                'type' => 'physical',
                'parent_id' => $herbalRemedies->id,
                'status' => 1,
                'image_path' => 'categories/immune.jpg',
            ]);
            Category::create([
                'name' => 'Stress Relief',
                'slug' => Str::slug('Stress Relief'),
                'type' => 'physical',
                'parent_id' => $herbalRemedies->id,
                'status' => 1,
                'image_path' => 'categories/stress.jpg',
            ]);
        }
    }
}

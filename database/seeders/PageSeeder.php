<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Page;
use App\Models\Category;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Page::truncate();
        $faker = Faker::create();

        $categories = Category::all();

        if ($categories->isEmpty()) {
            $this->call(CategorySeeder::class);
            $categories = Category::all();
        }

        foreach ($categories as $category) {
            for ($i = 0; $i < 3; $i++) { // Create 3 pages per category
                $pageName = $faker->sentence(3);
                Page::create([
                    'category_id' => $category->id,
                    'name' => $pageName,
                    'slug' => Str::slug($pageName . '-' . Str::random(5)),
                    'slider_content' => $faker->paragraph(3),
                    'paragraph_content' => $faker->paragraphs(5, true),
                    'image_paths' => json_encode([
                        'pages/page-' . rand(1, 3) . '.jpg',
                        'pages/page-' . rand(4, 6) . '.jpg',
                    ]),
                    'is_published' => $faker->boolean(70), // 70% chance of being published
                ]);
            }
        }
    }
}

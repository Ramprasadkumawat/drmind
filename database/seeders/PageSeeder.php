<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Page;
use App\Models\Category;
use Illuminate\Support\Str;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Page::truncate();
        $faker = Faker::create();

        $categories = Category::all();

        if ($categories->isEmpty()) {
            $this->call(CategorySeeder::class);
            $categories = Category::all();
        }

        // Create a dedicated homepage
        $homepageCategory = $categories->random(); // Assign a random category for the homepage
        Page::create([
            'category_id' => $homepageCategory->id,
            'name' => 'Dynamic Home Page',
            'slug' => 'dynamic-home-page',
            'content' => $faker->paragraph(3) . "\n\n" . $faker->paragraphs(5, true),
            'image_paths' => json_encode([
                'https://picsum.photos/seed/homepage-section-1/800/400',
                'https://picsum.photos/seed/homepage-section-2/800/400',
            ]),
            'is_published' => true,
            'is_homepage' => true,
            'slider_text' => 'Welcome to our Dynamic Homepage!',
            'slider_image_path' => 'https://picsum.photos/seed/homepage-slider/1200/500',
            'main_paragraph_content' => $faker->paragraphs(7, true) . ' ' . $faker->paragraphs(3, true),
            'extr-image_paths' => json_encode([
                'https://picsum.photos/seed/extra-image-1/400/300',
                'https://picsum.photos/seed/extra-image-2/400/300',
            ]),
        ]);

        foreach ($categories as $category) {
            for ($i = 0; $i < 3; $i++) { // Create 3 pages per category
                $pageName = $faker->sentence(3);
                Page::create([
                    'category_id' => $category->id,
                    'name' => $pageName,
                    'slug' => Str::slug($pageName . '-' . Str::random(5)),
                    'content' => $faker->paragraph(3) . "\n\n" . $faker->paragraphs(5, true),
                    'image_paths' => json_encode([
                        'https://picsum.photos/seed/page-image-' . rand(1, 3) . '/800/400',
                        'https://picsum.photos/seed/page-image-' . rand(4, 6) . '/800/400',
                    ]),
                    'is_published' => $faker->boolean(70), // 70% chance of being published
                ]);
            }
        }

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}

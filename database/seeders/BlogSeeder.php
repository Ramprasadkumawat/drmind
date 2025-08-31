<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Blog;
use Illuminate\Support\Str;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class BlogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Blog::truncate();
        $faker = Faker::create();

        for ($i = 0; $i < 10; $i++) { // Create 10 blog posts
            $title = $faker->sentence(6);
            Blog::create([
                'title' => $title,
                'slug' => Str::slug($title . '-' . Str::random(5)),
                'status' => $faker->randomElement(['draft', 'publish']),
                'image' => 'blogs/blog-' . rand(1, 5) . '.jpg',
                'message' => $faker->paragraphs(4, true),
            ]);
        }

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}

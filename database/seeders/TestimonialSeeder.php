<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Testimonial;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

class TestimonialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Testimonial::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        $faker = Faker::create();

        for ($i = 0; $i < 5; $i++) { // Create 5 testimonials
            $title = $faker->sentence(4);
            Testimonial::create([
                'title' => $title,
                'slug' => Str::slug($title . '-' . Str::random(5)),
                'status' => $faker->randomElement(['pending', 'publish']),
                'image' => 'testimonials/testimonial-' . rand(1, 5) . '.jpg',
                'description' => $faker->paragraphs(2, true),
            ]);
        }
    }
}

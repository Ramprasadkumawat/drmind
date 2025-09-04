<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Broadcast;
use App\Models\User;
use Illuminate\Support\Str;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class BroadcastSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Broadcast::truncate();
        $faker = Faker::create();

        $users = User::all();

        if ($users->isEmpty()) {
            $this->call(UserSeeder::class);
            $users = User::all();
        }

        foreach ($users as $user) {
            for ($i = 0; $i < 2; $i++) { // Create 2 broadcasts per user
                $title = $faker->sentence(5);
                Broadcast::create([
                    'user_id' => $user->id,
                    'title' => $title,
                    'slug' => Str::slug($title . '-' . Str::random(5)),
                    'message' => $faker->paragraphs(3, true),
                    'image' => 'broadcasts/broadcast-' . rand(1, 5) . '.jpg',
                    'facebook_count' => $faker->numberBetween(0, 100),
                    'instagram_count' => $faker->numberBetween(0, 100),
                    'wechat_count' => $faker->numberBetween(0, 100),
                    'whatsapp_count' => $faker->numberBetween(0, 100),
                    'tiktok_count' => $faker->numberBetween(0, 100),
                    'youtube_count' => $faker->numberBetween(0, 100),
                ]);
            }
        }

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}

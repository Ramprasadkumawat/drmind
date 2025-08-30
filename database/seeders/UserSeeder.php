<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->truncate(); // Remove old data

        $users = [];
        $referralMap = []; // [referral_code => user array]

        // Step 1: Generate 100 users first with referral_code
        for ($i = 1; $i <= 100; $i++) {
            $referral_code = Str::random(8);
            $user = [
                'name' => fake()->name(),
                'email' => fake()->unique()->safeEmail(),
                'referral_code' => $referral_code,
                'referral_by' => null, // we'll assign later
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'earning_point' => rand(1000, 10000),
                'phone' => fake()->phoneNumber(),
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ];

            $users[] = $user;
            $referralMap[$referral_code] = &$users[$i - 1];
        }

        // Step 2: Now randomly assign referral_by for levels
        foreach ($users as $key => &$user) {
            if ($key < 5) continue; // first 5 users = root (no referral_by)

            // Randomly assign referral_by from existing users
            $possibleReferrers = array_slice($users, 0, $key);
            $referrer = $possibleReferrers[array_rand($possibleReferrers)];

            $user['referral_by'] = $referrer['referral_code'];
        }

        DB::table('users')->insert($users);
    }
}

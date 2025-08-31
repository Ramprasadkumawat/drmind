<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use App\Models\User; // Use the User model
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        User::truncate(); // Clear old data using the model

        $faker = Faker::create();

        // Create a specific admin user
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'is_admin' => true,
            'email_verified_at' => now(),
            'referral_code' => Str::random(8),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Create a specific regular user
        User::create([
            'name' => 'Regular User',
            'email' => 'user@example.com',
            'password' => Hash::make('password'),
            'is_admin' => false,
            'email_verified_at' => now(),
            'referral_code' => Str::random(8),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $users = [];
        $referralMap = []; // [referral_code => user array]

        // Step 1: Generate 100 users first with referral_code
        for ($i = 1; $i <= 100; $i++) {
            $referral_code = Str::random(8);
            $user = [
                'name' => $faker->name(),
                'email' => $faker->unique()->safeEmail(),
                'referral_code' => $referral_code,
                'referral_by' => null, // we'll assign later
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'earning_point' => rand(1000, 10000),
                'phone' => $faker->phoneNumber(),
                'remember_token' => Str::random(10),
                'is_admin' => false, // Ensure non-admin for dummy users
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

        // Insert the dynamically generated users
        User::insert($users);

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}

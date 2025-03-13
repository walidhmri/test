<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $faker = Faker::create();

        for ($i = 0; $i < 10; $i++) {
            User::create([
                'name' => $faker->name,  // اسم عشوائي
                'email' => (string) Str::uuid(), // تحويل UUID إلى نص ليكون كـ user_id
                'password' => bcrypt('password'), // تشفير كلمة المرور
                'role' => 'employee'
            ]);
        }
    }
}

<?php

namespace Database\Seeders;

use App\Models\Teket;
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
        User::create(
            [
                'name' => 'Admin',
                'email' => 12345,
                'password' => bcrypt('password'),
                'role' => 'admin'
            ]
            );
        User::create(
            [
                'name' => 'Employee',
                'email' => 12,
                'password' => bcrypt('password'),
                'role' => 'user'
            ]
            );
        User::create(
            [
                'name' => 'Ingenieur',
                'email' => 1234,
                'password' => bcrypt('password'),
                'role' => 'ingenieur'
               ]
            );

        for ($i = 0; $i < 10; $i++) {
            User::create([
                'name' => $faker->name,  // اسم عشوائي
                'email' => (string) Str::uuid(), // تحويل UUID إلى نص ليكون كـ user_id
                'password' => bcrypt('password'), // تشفير كلمة المرور
                'role' => 'user'
            ]);
        }
        for ($i = 0; $i < 10; $i++) {
            Teket::create([
                'title' => $faker->title ,  // اسم عشوائي
                'description' => $faker->paragraph, // تحويل UUID إلى نص ليكون كـ user_id
                'status' => 'pending', // تشفير كلمة المرور
                'priority' => 'low',
                'user_id' => 2
            ]);
        }
    }
}

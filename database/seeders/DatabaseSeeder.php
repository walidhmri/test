<?php

namespace Database\Seeders;

use App\Models\Faq;
use App\Models\Solution;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Database\Seeder;
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
                'name' => 'Admin Oualid',
                'email' => 12345,
                'password' => bcrypt('password'),
                'role' => 'admin'
            ]
            );
        User::create(
            [
                'name' => 'Employee Test',
                'email' => 12,
                'password' => bcrypt('password'),
                'role' => 'user'
            ]
            );
        User::create(
            [
                'name' => 'Ingenieur Test',
                'email' => 1234,
                'password' => bcrypt('password'),
                'role' => 'ingenieur'
               ]
            );

        for ($i = 0; $i < 10; $i++) {
            User::create([
                'name' => $faker->name,  
                'email' => fake()->unique()->randomNumber(9, true),
                'password' => bcrypt('password'), 
                'role' => 'user'
                
            ]);
        }
        for ($i = 0; $i < 10; $i++) {
            User::create([
                'name' => $faker->name,  
                'email' => fake()->unique()->randomNumber(9, true),
                'password' => bcrypt('password'), 
                'role' => 'ingenieur'
                    
            ]);
        }
        for ($i = 0; $i < 10; $i++) {
            Ticket::create([
                'title' => $faker->sentence,  // small title
                'description' => $faker->paragraph, 
                'status' => 'pending', 
                'priority' => 'low',
                'user_id' => 2
            ]);
        }
        for ($i = 0; $i < 10; $i++) {
            $ticket = Ticket::create([
                'title' => $faker->sentence ,  
                'description' => $faker->paragraph, 
                'status' => 'solved', 
                'priority' => 'medium',
                'user_id' => 2
            ]);

            $solution= Solution::create([
                'title' => 'Solution example for solved Tickets',
                'description' => $faker->paragraph,
                'user_id' => 1,
                'Ticket_id' => $ticket->id
            ]);
        }
        for ($i = 0; $i < 10; $i++) {
            Ticket::create([
                'title' => $faker->sentence ,  
                'description' => $faker->paragraph, 
                'status' => 'closed', 
                'priority' => 'high',
                'user_id' => 2
            ]);
        }
        for ($i = 0; $i < 10; $i++) {
            Ticket::create([
                'title' => $faker->sentence ,  
                'description' => $faker->paragraph, 
                'status' => 'closed', 
                'priority' => 'urgent',
                'user_id' => 2
            ]);
        }
        for ($i = 0; $i < 10; $i++) {
            Faq::create([
                'question' => $faker->sentence ,  
                'answer' => $faker->sentence, 
            ]);
        }
    }
}

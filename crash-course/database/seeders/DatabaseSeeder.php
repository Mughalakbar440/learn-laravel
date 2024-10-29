<?php

namespace Database\Seeders;

use App\Models\Notes;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Notes::factory(100)->create();
        
        // User::factory()->create([
        //     'id'=>1,
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        //     'password'=>bcrypt('husain@123'),
        // ]);
    }
}
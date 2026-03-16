<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create an Admin User
        User::factory()->create([
            'name'     => 'Admin Goodness',
            'email'    => 'admin@awards.com',
            'password' => Hash::make('admin123'), // Your login password
            'role'     => 'admin',               // Important for your Admin Middleware
        ]);

        // Optional: Create a standard test user
        User::factory()->create([
            'name'  => 'Test User',
            'email' => 'test@example.com',
            'role'  => 'user',
        ]);
    }
}
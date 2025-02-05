<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create an Admin User
        User::updateOrCreate(
            ['email' => 'admin@example.com'], // Prevent duplicate entries
            [
                'name' => 'Admin User',
                'password' => Hash::make('admin123'), // Securely hash the password
                'role' => 'admin',
            ]
        );

        // Create a Regular User
        User::updateOrCreate(
            ['email' => 'user@example.com'], // Prevent duplicate entries
            [
                'name' => 'Regular User',
                'password' => Hash::make('user123'),
                'role' => 'user',
            ]
        );
    }
}

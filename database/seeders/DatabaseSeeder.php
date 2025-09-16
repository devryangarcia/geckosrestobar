<?php

namespace Database\Seeders;

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
        // User::factory(10)->create();

        // Admin user
        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@gmail.com',
            'role' => 'admin',
            'password' => bcrypt('admin123'), // 👈 set password
        ]);

        // Staff user
        User::factory()->create([
            'name' => 'Staff User',
            'email' => 'staff@gmail.com',
            'role' => 'staff',
            'password' => bcrypt('staff123'), // 👈 set password
        ]);
    }
}

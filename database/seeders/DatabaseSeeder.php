<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create Admin User
        User::updateOrCreate(
            ['email' => 'admin@bpsctech.in'],
            [
                'name' => 'Admin User',
                'password' => Hash::make('admin123'),
                'role' => 'Admin',
                'designation' => 'Super Admin'
            ]
        );

        // Create a Sample Employee
        User::updateOrCreate(
            ['email' => 'employee@bpsctech.in'],
            [
                'name' => 'Sample Employee',
                'password' => Hash::make('employee123'),
                'role' => 'Employee',
                'designation' => 'Lower Division Clerk'
            ]
        );
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminEmail = env('ADMIN_EMAIL', 'admin@bpsctech.com');
        $adminPass = env('ADMIN_PASS', 'admin123');

        if (!User::where('role', 'Admin')->exists()) {
            User::create([
                'name' => 'Admin',
                'email' => $adminEmail,
                'password' => Hash::make($adminPass),
                'role' => 'Admin',
                'designation' => 'System Administrator'
            ]);
            $this->command->info('Admin user created successfully.');
        } else {
            $this->command->warn('Admin user already exists.');
        }
    }
}

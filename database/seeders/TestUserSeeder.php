<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class TestUserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin Smart Manager',
                'password' => Hash::make('Admin12345!'),
                'role' => User::ROLE_ADMIN,
                'email_verified_at' => now(),
                'phone_number' => '+212600000001',
                'address' => 'Casablanca, Maroc',
            ]
        );

        User::updateOrCreate(
            ['email' => 'user@example.com'],
            [
                'name' => 'Employee User',
                'password' => Hash::make('User12345!'),
                'role' => User::ROLE_USER,
                'email_verified_at' => now(),
                'phone_number' => '+212600000002',
                'address' => 'Rabat, Maroc',
            ]
        );

        User::updateOrCreate(
            ['email' => 'customer@example.com'],
            [
                'name' => 'Test Customer',
                'password' => Hash::make('Customer12345!'),
                'role' => User::ROLE_USER,
                'email_verified_at' => now(),
                'phone_number' => '+212600000003',
                'address' => 'Marrakech, Maroc',
            ]
        );
    }
}
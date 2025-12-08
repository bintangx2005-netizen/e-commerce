<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::insert([
            'name' => 'Admin',
            'user_name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'status' => 'active'
        ]);
        User::insert([
            'name' => 'Vendor',
            'user_name' => 'vendor',
            'email' => 'vendor@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'vendor',
            'status' => 'active'
        ]);
        User::insert([
            'name' => 'User',
            'user_name' => 'user',
            'email' => 'user@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'user',
            'status' => 'active'
        ]);
    }
}
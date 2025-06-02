<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        User::create([
            'name' => 'raihan fikri',
            'role' => 'user',
            'email' => 'raihan@gmail.com',
            'password' => Hash::make('password123'), 
        ]);

        User::create([
            'name' => 'Wisnu Yogi Pamungkas',
            'role' => 'user',
            'email' => 'yogi@gmail.com',
            'password' => Hash::make('password123'), 
        ]);
    }
}
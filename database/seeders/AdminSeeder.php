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
        User::create([
            'name' => 'Radja Ravine Salfriandry',
            'role' => 'admin',
            'email' => 'ravinesalf@gmail.com',
            'password' => Hash::make('password123'),
        ]);
    }
}
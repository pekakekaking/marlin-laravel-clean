<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\User;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $user = [
            'name' => 'user',
            'email' => 'user@gmail.com',
            'password' => Hash::make('password'),
        ];

        User::firstOrCreate([
            'email' => $user['email']
        ], [
            'name' => 'user',
            'password' => Hash::make('password'),
        ]);

        $this->call([
            CategorySeeder::class,
            PostSeeder::class,
        ]);
    }
}

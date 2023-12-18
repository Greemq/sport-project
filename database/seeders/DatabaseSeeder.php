<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::create([
            'email' => 'admin@mail.ru',
            'password' => bcrypt('123456'),
            'name' => 'admin',
            'role_id' => 1
        ]);
    }
}

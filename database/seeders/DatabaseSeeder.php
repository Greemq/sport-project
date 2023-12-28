<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\ColorScheme;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
//        $users = [
//            ['name' => 'admin', 'email' => '1@mail.ru', 'password' => bcrypt('111111'), 'role_id' => 1],
//            ['name' => 'trainer', 'email' => '2@mail.ru', 'password' => bcrypt('111111'), 'role_id' => 2],
//            ['name' => 'chief', 'email' => '3@mail.ru', 'password' => bcrypt('111111'), 'role_id' => 3],
//            ['name' => 'judge', 'email' => '4@mail.ru', 'password' => bcrypt('111111'), 'role_id' => 4],
//        ];
//        foreach ($users as $user) {
//            User::create($user);
//        }
        ColorScheme::create(['id' => 1, 'theme' => true]);
    }
}

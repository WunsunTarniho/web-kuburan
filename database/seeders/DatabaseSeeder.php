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
        // \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'name' => 'Wunsun Tarniho',
            'email' => 'wunsun49@gmail.com',
            'level' => 'admin',
            'password' => 'wunsun#1234',
        ]);
    }
}

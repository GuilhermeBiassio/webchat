<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\Hash;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Guilherme Biassio',
            'email' => 'gbiassio132@gmail.com',
            'password' => Hash::make('costela2019')
        ]);

        User::factory()
        ->count(10)
        ->create();
    }
}

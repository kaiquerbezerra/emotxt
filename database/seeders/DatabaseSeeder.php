<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Config;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        if (Config::get('app.env') !== 'production' && true) {
            \App\Models\User::factory()->count(5)->create();
            \App\Models\Entry::factory()->count(5)->create();
        }
    }
}

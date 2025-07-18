<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Jalankan seeder khusus untuk user tetap
        $this->call([
            UserSeeder::class,
        ]);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin.admin@locatorgis.test'],
            [
                'name' => 'Admin',
                'username' => 'Admin-locatorgis',
                'role' => 'admin',
                'password' => Hash::make('locatorgis2025'),
            ]
        );

        User::updateOrCreate(
            ['email' => 'operator.operator@locatorgis.test'],
            [
                'name' => 'Operator',
                'username' => 'Operator-locatorgis',
                'role' => 'operator',
                'password' => Hash::make('2025locatorgis'),
            ]
        );
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class DefaultUsersSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Default',
            'last_name' => 'User',
            'dni' => '00000001',
            'email' => 'user@example.com',
            'password' => Hash::make('password'),
            'role_id' => 1,
        ]);

        User::create([
            'name' => 'Admin',
            'last_name' => 'User',
            'dni' => '00000002',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'role_id' => 2,
        ]);

        User::create([
            'name' => 'Operador',
            'last_name' => 'User',
            'dni' => '00000003',
            'email' => 'operator@example.com',
            'password' => Hash::make('password'),
            'role_id' => 4,
        ]);

        User::create([
            'name' => 'Funcionario',
            'last_name' => 'User',
            'dni' => '00000004',
            'email' => 'funcionario@example.com',
            'password' => Hash::make('password'),
            'role_id' => 3,
        ]);
    }
}

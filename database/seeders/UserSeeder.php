<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('users')->truncate();

        $users = [
            [
                'name' => 'Admin',
                'last_name' => 'Sistema',
                'email' => 'admin@example.com',
                'dni' => '12345678',
                'role_id' => 1,
                'password' => Hash::make('password123'), // Contraseña encriptada
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Secretario',
                'last_name' => 'Facultad',
                'email' => 'secretario@example.com',
                'dni' => '22345678',
                'role_id' => 2,
                'password' => Hash::make('password123'),
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Decano',
                'last_name' => 'Facultad',
                'email' => 'decano@example.com',
                'dni' => '32345678',
                'role_id' => 3,
                'password' => Hash::make('password123'),
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Usuario',
                'last_name' => 'Regular',
                'email' => 'usuario@example.com',
                'dni' => '42345678',
                'role_id' => 4,
                'password' => Hash::make('password123'),
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Product',
                'last_name' => 'Owner',
                'email' => 'owner@example.com',
                'dni' => '52345678',
                'role_id' => 5,
                'password' => Hash::make('password123'),
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now()
            ]
        ];

        foreach ($users as $user) {
            DB::table('users')->insert($user);
        }

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        
        // Opcional: Crear usuarios de prueba con factory
        User::factory(10)->create();
    }
}
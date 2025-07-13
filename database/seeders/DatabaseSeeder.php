<?php

namespace Database\Seeders;

use App\Models\User;
use Database\Seeders\DependenciaSeeder;
use Database\Seeders\TramiteSeeder;
use Database\Seeders\FacultadSeeder;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test',
            'last_name' => 'User',
            'email' => 'test@example.com',
            'dni' => '12345678',
            'role_id' => 1,
        ]);

        $this->call([
            DependenciaSeeder::class,
            TramiteSeeder::class,
            FacultadSeeder::class,
        ]);
    }
}

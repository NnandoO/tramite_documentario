<?php

namespace Database\Seeders;

use Database\Seeders\DependenciaSeeder;
use Database\Seeders\TramiteSeeder;
use Database\Seeders\FacultadSeeder;
use Database\Seeders\RoleSeeder;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            UserSeeder::class,
            DependenciaSeeder::class,
            TramiteSeeder::class,
            FacultadSeeder::class,
        ]);
    }
}
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
    public function run()
{
    $this->call([
        UserSeeder::class, // ← Añade esta línea
        DependenciaSeeder::class,
        TramiteSeeder::class,
        FacultadSeeder::class,
    ]);
}
}
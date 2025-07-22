<?php

namespace Database\Seeders;

use App\Models\User;
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

        $this->call([
            FacultadSeeder::class,
            MonthSeeder::class,
            TramiteTypeSeeder::class,
            StatusSeeder::class,
            ExpedientesSeeder::class,
            DefaultUsersSeeder::class,
            TramiteConstanciaExpeditoProfesionalSeeder::class,
            DetalleTramiteSeeder::class,
            Requisito1Seeder::class,
            Requisito2Seeder::class,
            Requisito3Seeder::class,
            Requisito4Seeder::class,
            Requisito5Seeder::class,
            Requisito6Seeder::class,
            Requisito7Seeder::class,
            Requisito8Seeder::class,
            Requisito9Seeder::class,
            Requisito10Seeder::class,
            Requisito11Seeder::class,
            Requisito12Seeder::class,
            Requisito13Seeder::class,
            Requisito14Seeder::class,

        ]);
    }
}

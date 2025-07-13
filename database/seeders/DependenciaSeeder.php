<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Dependencia;

class DependenciaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Dependencia::factory()->count(3)->create();
    }
}

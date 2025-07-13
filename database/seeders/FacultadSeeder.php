<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Facultad;

class FacultadSeeder extends Seeder
{
    public function run(): void
    {
        Facultad::factory()->count(3)->create();
    }
}

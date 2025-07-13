<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tramite;

class TramiteSeeder extends Seeder
{
    public function run(): void
    {
        Tramite::factory()->count(3)->create();
    }
}

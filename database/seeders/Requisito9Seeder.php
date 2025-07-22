<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Requisito9;

class Requisito9Seeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $datos = [
            1 => 'SOLICITUD DIRIGIDA AL DECANO DE LA FACULTAD',
            2 => 'PAGO POR DERECHO DE CONSTANCIA - Costo : s/. 5.00',
            3 => 'PAGO POR DERECHO DE TRÁMITE DOCUMENTARIO - Costo : s/. 3.00',
            4 => 'PAGO POR TRÁMITE',
        ];

        foreach ($datos as $id => $descripcion) {
            Requisito9::updateOrCreate(
                ['id' => $id],
                ['descripcion' => $descripcion]
            );
        }
    }
}

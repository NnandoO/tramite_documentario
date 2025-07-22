<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Requisito4;

class Requisito4Seeder extends Seeder
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
            Requisito4::updateOrCreate(
                ['id' => $id],
                ['descripcion' => $descripcion]
            );
        }
    }
}

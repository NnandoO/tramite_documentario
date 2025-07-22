<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Requisito10;

class Requisito10Seeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $datos = [
            1 => 'SOLICITUD DIRIGIDA AL DECANO DE LA FACULTAD',
            2 => 'INFORME JUSTIFICATORIO DEL ASESOR',
            3 => 'PAGO POR DERECHO DE TRAMITE DOCUMENTARIO',
        ];

        foreach ($datos as $id => $descripcion) {
            Requisito10::updateOrCreate(
                ['id' => $id],
                ['descripcion' => $descripcion]
            );
        }
    }
}

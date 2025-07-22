<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Requisito12;

class Requisito12Seeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $datos = [
            1 => 'SOLICITUD DIRIGIDA AL DECANO DE LA FACULTAD',
            2 => 'ACTA DE SUSTENTACIÓN DE TESIS',
            3 => 'PAGO POR DERECHO DE TRAMITE DOCUMENTARIO - Costo : s/. 3.00',
            4 => 'PAGO POR DERECHO DE TRAMITE DOCUMENTARIO',
        ];

        foreach ($datos as $id => $descripcion) {
            Requisito12::updateOrCreate(
                ['id' => $id],
                ['descripcion' => $descripcion]
            );
        }
    }
}

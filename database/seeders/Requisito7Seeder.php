<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Requisito7;

class Requisito7Seeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $datos = [
            1 => 'SOLICITUD DIRIGIDA AL JEFE DE LA UNIDAD DE RECURSOS HUMANOS',
            2 => 'INFORME DE PRÁCTICAS DEL INTERESADO',
            3 => 'REPORTE DE ASISTENCIA DEL PRACTICANTE',
            4 => 'PAGO POR DERECHO DE TRAMITE DOCUMENTARIO - Costo : s/. 3.00',
            5 => 'PAGO POR DERECHO DE CERTIFICADO - Costo : s/. 5.00',
            6 => 'PAGO POR TRAMITE',
        ];

        foreach ($datos as $id => $descripcion) {
            Requisito7::updateOrCreate(
                ['id' => $id],
                ['descripcion' => $descripcion]
            );
        }
    }
}

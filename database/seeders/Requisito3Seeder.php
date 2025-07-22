<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Requisito3;

class Requisito3Seeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $datos = [
            1 => 'SOLICITUD DIRIGIDA AL DECANO DE LA FACULTAD',
            2 => 'UNA (01) FOTOGRAFÍA TAMAÑO CARNÉ CON TERNO FONDO BLANCO FORMATO (JPG)',
            3 => 'PAGO POR DERECHO DE TRÁMITE DOCUMENTARIO - Costo : s/. 3.00',
            4 => 'PAGO POR DERECHO DE CONSTANCIA - Costo : s/. 5.00',
            5 => 'CONSTANCIAS DEL CENTRO DE SALUD DEL INTERNADO COMUNITARIO Y/O CLÍNICO',
            6 => 'CERTIFICADO DE CAPACITACIÓN APROBADO',
            7 => 'CASO DE ESTUDIO CLÍNICO',
            8 => 'INSTRUMENTOS DE EVALUACION CON NOTA APROBATORIA',
            9 => 'PAGO POR TRÁMITE DOCUMENTARIO Y CONSTANCIA',
        ];

        foreach ($datos as $id => $descripcion) {
            Requisito3::updateOrCreate(
                ['id' => $id],
                ['descripcion' => $descripcion]
            );
        }
    }
}

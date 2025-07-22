<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Requisito13;

class Requisito13Seeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $datos = [
            1 => 'SOLICITUD DIRIGIDA AL DIRECTOR DE LA UNIDAD DE POSGRADO',
            2 => 'EJEMPLAR DIGITAL (TESIS SEGÚN FORMATO SUNEDU) CON REPORTE DE ORIGINALIDAD FIRMADO POR EL ASESOR',
            3 => 'FORMATO DE AUTORIZACIÓN Y/O EMBARGO PARA PUBLICACIÓN DE TESIS. (DESCARGAR DE LA WEB O SOLICITAR EN LAS UNIDADES)',
            4 => 'PAGO POR DERECHO DE DIPLOMA, PAGO POR DERECHO DE TRÁMITE DOCUMENTARIO, PAGO POR DERECHO DE FICHA ESTADÍSTICA',
            5 => 'PAGO POR DERECHO DE FICHA ESTADÍSTICA - Costo : s/. 5.00',
            6 => 'PAGO POR DERECHO DE TRÁMITE DOCUMENTARIO. - Costo : s/. 3.00',
            7 => 'PAGO POR DERECHO DE DIPLOMA - Costo : s/. 500.00',
        ];

        foreach ($datos as $id => $descripcion) {
            Requisito13::updateOrCreate(
                ['id' => $id],
                ['descripcion' => $descripcion]
            );
        }
    }
}

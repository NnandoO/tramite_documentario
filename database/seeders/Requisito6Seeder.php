<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Requisito6;

class Requisito6Seeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $datos = [
            1 => 'UNA (01) FOTOGRAFÍA ACTUAL, CON TERNO OSCURO EN FONDO BLANCO Y A COLORES (FORMATO JPG)',
            2 => 'SOLICITUD DIRIGIDA AL JEFE DE LA UNIDAD DE GESTIÓN ACADÉMICA',
            3 => 'BOUCHER DEL PAGO DE TRAMITE',
            4 => 'PAGO POR DERECHO DE FORMATO 01 (POR HOJA) - Costo : s/. 20.00',
            5 => 'PAGO POR DERECHO DE TRAMITE DOCUMENTARIO - Costo : s/. 3.00',
        ];

        foreach ($datos as $id => $descripcion) {
            Requisito6::updateOrCreate(
                ['id' => $id],
                ['descripcion' => $descripcion]
            );
        }
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Requisito8;

class Requisito8Seeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $datos = [
            1 => 'SOLICITUD DIRIGIDA AL DECANO',
            2 => 'RECIBO POR CONSTANCIA - Costo : s/. 5.00',
            3 => 'RECIBO POR TRÁMITE DOCUMENTARIO - Costo : s/. 3.00',
            4 => 'RECIBO POR TRÁMITE Y CONSTANCIA EN PDF',
        ];

        foreach ($datos as $id => $descripcion) {
            Requisito8::updateOrCreate(
                ['id' => $id],
                ['descripcion' => $descripcion]
            );
        }
    }
}

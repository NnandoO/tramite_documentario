<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
// 1) Importa tu modelo
use App\Models\DetalleTramite;

class DetalleTramiteSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $datos = [
            ['id' => 1,  'duracion' => 5,  'area_inicio' => 'Unidad de Administración Documentaria'],
            ['id' => 2,  'duracion' => 30, 'area_inicio' => 'Unidad de Administración Documentaria'],
            ['id' => 3,  'duracion' => 3,  'area_inicio' => 'Unidad de Administración Documentaria'],
            ['id' => 4,  'duracion' => 3,  'area_inicio' => 'Unidad de Administración Documentaria'],
            ['id' => 5,  'duracion' => 3,  'area_inicio' => 'Unidad de Administración Documentaria'],
            ['id' => 6,  'duracion' => 5,  'area_inicio' => 'Unidad de Administración Documentaria'],
            ['id' => 7,  'duracion' => 3,  'area_inicio' => 'Unidad de Administración Documentaria'],
            ['id' => 8,  'duracion' => 3,  'area_inicio' => 'Unidad de Administración Documentaria'],
            ['id' => 9,  'duracion' => 2,  'area_inicio' => 'Unidad de Administración Documentaria'],
            ['id' => 10, 'duracion' => 5,  'area_inicio' => 'Unidad de Administración Documentaria'],
            ['id' => 11, 'duracion' => 4,  'area_inicio' => 'Unidad de Administración Documentaria'],
            ['id' => 12, 'duracion' => 30, 'area_inicio' => 'Unidad de Administración Documentaria'],
            ['id' => 13, 'duracion' => 30, 'area_inicio' => 'Unidad de Administración Documentaria'],
            ['id' => 14, 'duracion' => 10, 'area_inicio' => 'Unidad de Administración Documentaria'],
        ];

        foreach ($datos as $fila) {
            // 2) Usa la clase correcta: DetalleTramite (no DetallesTramite)
            DetalleTramite::updateOrCreate(
                ['id' => $fila['id']],
                [
                    'duracion'    => $fila['duracion'],
                    'area_inicio' => $fila['area_inicio'],
                ]
            );
        }

    }
}

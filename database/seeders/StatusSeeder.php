<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    public function run(): void
    {
        $statuses = [
            'Pendiente',
            'Progreso',
            'En Revisión',
            'Atendido',
            'Aprobado',
            'Rechazado',
            'Enviado',
            'Canalizado',
            'Finalizado',
            'Derivado',
            'Archivado'
        ];

        foreach ($statuses as $name) {
            \App\Models\Status::firstOrCreate(['name' => $name]);
        }
    }
}

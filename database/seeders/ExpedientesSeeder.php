<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Expedientes;
use App\Models\Facultad;


class ExpedientesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tipos = ['Solicitud', 'Constancia', 'Certificado', 'Resolución', 'Informe', 'Memorando', 'Oficio'];
        $estados = ['Pendiente', 'En Proceso', 'Finalizado'];
        $meses = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio'];

        $facultades = Facultad::pluck('id')->toArray(); // Obtener solo los IDs

        for ($i = 1; $i <= 20; $i++) {
            Expedientes::create([
                'name' => 'Solicitante ' . $i,
                'year' => rand(2021, 2025),
                'month' => $meses[array_rand($meses)],
                'faculty_id' => $facultades[array_rand($facultades)],
                'document_type' => $tipos[array_rand($tipos)],
                'status' => $estados[array_rand($estados)],
            ]);
        }
    }
}

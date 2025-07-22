<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TramiteTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types = [
            'Constancia de expedito para optar título profesional',
            'Constancia de expedito para grado de bachiller',
            'Constancia de prácticas preprofesionales/internado',
            'Constancia de inscripción, aprobación y asesoramiento del plan de tesis',
            'Constancia de egresado (bachiller y título profesional)',
            'Certificado de estudios de pregrado (formato 1)',
            'Certificado de prácticas preprofesionales y profesionales',
            'Constancia de récord académico, estudios, matrícula y otros',
            'Constancia con orden de mérito: décimo, quinto, tercio superior',
            'Cambio de título del plan de tesis / Cambio de asesor',
            'Ampliación de plazo para conclusión de ejecución de tesis',
            'Otorgar el título profesional',
            'Otorgar grado académico de maestro, doctor y título de segunda especialidad profesional',
            'Otros trámites',
        ];

        foreach ($types as $name) {
            \App\Models\TramiteType::create(['name' => $name]);
        }
    }
}

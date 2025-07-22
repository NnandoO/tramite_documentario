<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TramiteType;
use App\Models\RequisitosConstanciaExpeditoProfesional;

class TramiteConstanciaExpeditoProfesionalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tramites = [
            [
                'titulo' => 'CONSTANCIA DE EXPEDITO PARA OPTAR TÍTULO PROFESIONAL',
                'descripcion' => 'CONSTANCIA DE EXPEDITO PARA OPTAR TÍTULO PROFESIONAL',
                'duracion' => '5 días hábiles',
                'area' => 'Unidad de Administración Documentaria',
                'dependencia' => 'Sin asignar',
                'requiere_foto' => false,
                'requisitos' => [
                    'Solicitud dirigida al Decano de la Facultad',
                    'Informe y reporte de originalidad del software detector de similitud (Turnitin), firmado por el asesor de tesis',
                    'Constancia de asesoría de tesis',
                    'Constancia de sustentación de tesis',
                    'Resolución de aprobación de tesis',
                    'Resolución de aprobación de jurado',
                    'Acta de sustentación de tesis',
                    'Resolución de aprobación de título profesional',
                    'Recibo de pago por derecho de trámite',
                ]
            ],
            [
                'titulo' => 'CONSTANCIA DE EXPEDITO PARA GRADO DE BACHILLER',
                'descripcion' => 'CONSTANCIA DE EXPEDITO PARA GRADO DE BACHILLER',
                'duracion' => '30 días',
                'area' => 'Unidad de Administración Documentaria',
                'dependencia' => 'Sin Asignar',
                'requiere_foto' => true,
                'requisitos' => [
                    'Solicitud dirigida al Decano de la Facultad',
                    'Constancia de egresado',
                    'Constancia de no adeudo emitida por la Oficina de Grados y Títulos',
                    'Recibo de pago por derecho de trámite',
                    'Copia del DNI',
                    'Fotografía tamaño pasaporte (formato JPG)',
                ]
            ],
            [
                'titulo' => 'CONSTANCIA DE PRÁCTICAS PREPROFESIONALES/INTERNADO',
                'descripcion' => 'CONSTANCIA DE PRÁCTICAS PREPROFESIONALES/INTERNADO',
                'duracion' => '3 días',
                'area' => 'Unidad de Administración Documentaria',
                'dependencia' => 'Sin asignar',
                'requiere_foto' => true,
                'requisitos' => [
                    'Solicitud dirigida al decano de la facultad',
                    'Constancia o certificado de prácticas preprofesionales emitido por la empresa o institución (firmado y sellado)',
                    'Informe final de prácticas preprofesionales firmado por el alumno y el responsable de la empresa/institución',
                    'Constancia de matrícula de prácticas preprofesionales (emitida por la Oficina de Registros Académicos)',
                    'Copia del DNI',
                    'Recibo de pago por derecho de trámite',
                ]
            ],
        ];

        foreach ($tramites as $item) {
            $tramiteType = TramiteType::firstOrCreate(['name' => $item['titulo']]);

            $existing = RequisitosConstanciaExpeditoProfesional::where('tramite_type_id', $tramiteType->id)->first();

            if (!$existing) {
                RequisitosConstanciaExpeditoProfesional::create([
                    'tramite_type_id' => $tramiteType->id,
                    'titulo' => $item['titulo'],
                    'descripcion' => $item['descripcion'],
                    'duracion' => $item['duracion'],
                    'area' => $item['area'],
                    'dependencia' => $item['dependencia'],
                    'requiere_foto' => $item['requiere_foto'],
                    'requisitos' => $item['requisitos'],
                ]);
            } else {
                $existing->update([
                    'titulo' => $item['titulo'],
                    'descripcion' => $item['descripcion'],
                    'duracion' => $item['duracion'],
                    'area' => $item['area'],
                    'dependencia' => $item['dependencia'],
                    'requiere_foto' => $item['requiere_foto'],
                    'requisitos' => $item['requisitos'],
                ]);
            }
        }

        // Puedes añadir más tipos de trámites si es necesario
        $otrosTramites = [
            // Ejemplo: 'CONSTANCIA DE BUENA CONDUCTA',
        ];

        foreach ($otrosTramites as $titulo) {
            TramiteType::firstOrCreate(['name' => $titulo]);
        }

        echo "✅ Todos los trámites han sido registrados o actualizados.\n";
    }
}

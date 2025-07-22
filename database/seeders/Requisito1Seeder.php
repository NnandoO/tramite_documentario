<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Requisito1; 

class Requisito1Seeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $datos = [
            1  => 'SOLICITUD DIRIGIDA AL DECANO DE LA FACULTAD',
            2  => 'INFORME Y REPORTE DE ORIGINALIDAD DEL SOFTWARE DETECTOR DE SIMILITUD (TURNITIN) CON UN PORCENTAJE MÁXIMO DE SIMILITUD DEL 25% Y FIRMA DEL ASESOR EN TODAS LAS HOJAS',
            3  => 'INFORME DE LOS (03) TRES REVISORES, POR LO MENOS DOS DE ELLOS FAVORABLES',
            4  => 'INFORME DE CULMINACIÓN DE ASESORÍA DE TESIS DEL DOCENTE ASESOR',
            5  => 'CONSTANCIA ÚNICA DE NO ADEUDO (CUNA) CON ANTIGÜEDAD NO MAYOR DE SEIS MESES',
            6  => 'CONSTANCIA DE INSCRIPCIÓN DEL PLAN DE TESIS',
            7  => 'DIPLOMA DEL GRADO ACADÉMICO DE BACHILLER ESCANEADO AMBAS CARAS',
            8  => 'CONSTANCIA DE INSCRIPCIÓN SUNEDU DEL GRADO ACADÉMICO DE BACHILLER',
            9  => 'DECLARACIÓN JURADA SIMPLE NO TENER ANTECEDENTES PENALES, NI JUDICIALES',
            10 => 'CONSTANCIA DE EGRESADO',
            11 => 'CERTIFICADO DE ESTUDIOS',
            12 => 'FICHA DE MATRÍCULA DEL PRIMER SEMESTRE',
            13 => 'PAGO POR DERECHO DE CONSTANCIA - Costo : s/. 5.00',
            14 => 'PAGO POR DERECHO DE FICHA ESTADÍSTICA - Costo : s/. 2.00',
            15 => 'PAGO POR DERECHO DE DIPLOMA DE TÍTULO PROFESIONAL - Costo : s/. 188.00',
            16 => 'PAGO POR DERECHO DE TRÁMITE DOCUMENTARIO - Costo : s/. 3.00',
            17 => 'PAGO POR TRÁMITE',
            18 => 'ARCHIVO SUNEDU (EN .RAR)',
        ];

        foreach ($datos as $id => $descripcion) {
            Requisito1::updateOrCreate(
                ['id' => $id],
                ['descripcion' => $descripcion]
            );
        }
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Requisito2;

class Requisito2Seeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $datos = [
            1  => 'SOLICITUD DIRIGIDA AL DECANO DE LA FACULTAD',
            2  => 'CONSTANCIA DE EGRESADO',
            3  => 'CONSTANCIA DE PRÁCTICAS PREPROFESIONALES/INTERNADO',
            4  => 'CERTIFICADO DE PROYECCIÓN SOCIAL',
            5  => 'CERTIFICADO DE ESTUDIOS',
            6  => 'CERTIFICADO DE OFIMÁTICA',
            7  => 'CERTIFICADO DE IDIOMA EXTRANJERO O LENGUA NATIVA - nivel básico (ingresantes 2011-II)',
            8  => 'CONSTANCIA ÚNICA DE NO ADEUDO (CUNA) CON ANTIGÜEDAD NO MAYOR DE SEIS MESES',
            9  => 'DECLARACIÓN JURADA SIMPLE DE NO TENER ANTECEDENTES PENALES NI JUDICIALES',
            10 => 'FICHA DE MATRÍCULA DEL PRIMER SEMESTRE',
            11 => 'UNA (01) FOTOGRAFÍA TAMAÑO PASAPORTE CON TERNO FONDO BLANCO FORMATO (JPG)',
            12 => 'EN CASO DE TRASLADO (INTERNO Y/O EXTERNO) Y SEGUNDA CARRERA, DEBERÁN ADJUNTAR LA RESOLUCIÓN DE CONVALIDACIÓN DE ASIGNATURAS Y CUADRO DE CONVALIDACIONES',
            13 => 'PAGO POR DERECHO DE CONSTANCIA - Costo : s/. 5.00',
            14 => 'PAGO POR DERECHO DE DIPLOMA DE BACHILLER - Costo : s/. 110.00',
            15 => 'PAGO POR DERECHO DE FICHA ESTADÍSTICA - Costo : s/. 2.00',
            16 => 'PAGO POR DERECHO DE TRÁMITE DOCUMENTARIO - Costo : s/. 3.00',
            17 => 'PAGO POR TRÁMITE',
            18 => 'ACHIVO SUNEDU',
        ];

        foreach ($datos as $id => $descripcion) {
            Requisito2::updateOrCreate(
                ['id' => $id],
                ['descripcion' => $descripcion]
            );
        }
    }
}

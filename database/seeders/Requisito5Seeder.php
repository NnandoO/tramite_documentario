<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Requisito5;

class Requisito5Seeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $datos = [
            1  => 'SOLICITUD DIRIGIDA AL DECANO DE LA FACULTAD',
            2  => 'CERTIFICADO DE ESTUDIOS',
            3  => 'CERTIFICADO DE PROYECCIÓN SOCIAL',
            4  => 'CONSTANCIA DE PRÁCTICAS PREPROFESIONALES/INTERNADO',
            5  => 'CERTIFICADO DE OFIMÁTICA',
            6  => 'CERTIFICADO DE IDIOMA EXTRANJERO O LENGUA NATIVA - nivel básico (ingresantes 2011-II)',
            7  => 'UNA (01) FOTOGRAFÍA TAMAÑO CARNET A COLORES CON TERNO EN FONDO BLANCO FORMATO (JPG)',
            8  => 'PAGO POR DERECHO DE TRÁMITE DOCUMENTARIO - Costo : s/. 3.00',
            9  => 'PAGO POR DERECHO DE CONSTANCIA - Costo : s/. 5.00',
            10 => 'PAGO POR TRÁMITE',
            11 => 'CERTIFICADO DE 40 HORAS EXTRACURRICULARES',
            12 => 'REQUISITOS ADICIONALES PARA LA FACULTAD DE ARQUITECTURA: CERTIFICADO DE 40 HORAS EXTRACURRICULARES',
        ];

        foreach ($datos as $id => $descripcion) {
            Requisito5::updateOrCreate(
                ['id' => $id],
                ['descripcion' => $descripcion]
            );
        }
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FacultadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {   
        $facultades = [
    'Enfermería',
    'Medicina Humana',
    'Arquitectura',
    'Ingeniería Civil',
    'Ingeniería de Minas',
    'Ingeniería de Sistemas',
    'Ingeniería Eléctrica y Electrónica',
    'Ingeniería Mecánica',
    'Ingeniería Metalúrgica y de Materiales',
    'Ingeniería Química',
    'Ingeniería Química Industrial',
    'Ingeniería Química Ambiental',
    'Administración de Empresas',
    'Contabilidad',
    'Economía',
    'Administración de Negocios - Tarma',
    'Administración Hotelera y Turismo - Tarma',
    'Antropología',
    'Ciencias de la Comunicación',
    'Derecho y Ciencias Políticas',
    'Sociología',
    'Trabajo Social',
    'Educación Inicial',
    'Educación Primaria',
    'Educación Filosofía, Ciencias Sociales y Relaciones Humanas',
    'Educación Lengua, Literatura y Comunicación',
    'Educación Ciencias Naturales y Ambientales',
    'Educación Ciencias Matemáticas e Informática',
    'Educación Física y Psicomotricidad',
    'Agronomía',
    'Ciencias Forestales y del Ambiente',
    'Ingeniería en Industrias Alimentarias',
    'Zootecnia',
    'Ing. Agroindustrial - Tarma',
    'Ing. Agronomía Tropical - Satipo',
    'Ing. Forestal Tropical - Satipo',
    'Ing. Industrias Alimentarias Tropical - Satipo',
    'Zootecnia Tropical - Satipo',
];


        foreach ($facultades as $nombre) {
        DB::table('facultades')->insert([
            'nombre' => $nombre,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AlumnoSeeder extends Seeder
{
    public function run(): void
    {
        $alumnos = [
            [
                'id_user' => 7, // Laura Díaz Moreno
                'dni' => '12345678A',
                'numero_cuaderno' => 'DAM-2024-001',
                'id_ciclo' => 1, // DAM
                'curso_actual' => 2,
                'poblacion' => 'Madrid',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_user' => 8, // David Jiménez Castro
                'dni' => '23456789B',
                'numero_cuaderno' => 'DAW-2024-002',
                'id_ciclo' => 2, // DAW
                'curso_actual' => 2,
                'poblacion' => 'Barcelona',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_user' => 9, // Sara Muñoz Torres
                'dni' => '34567890C',
                'numero_cuaderno' => 'DAM-2024-003',
                'id_ciclo' => 1, // DAM
                'curso_actual' => 2,
                'poblacion' => 'Valencia',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_user' => 10, // Miguel Ángel Rubio Vega
                'dni' => '45678901D',
                'numero_cuaderno' => 'ASIR-2024-004',
                'id_ciclo' => 3, // ASIR
                'curso_actual' => 2,
                'poblacion' => 'Sevilla',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('alumnos')->insert($alumnos);
    }
}

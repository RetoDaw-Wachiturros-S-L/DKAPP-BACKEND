<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ModuloSeeder extends Seeder
{
    public function run(): void
    {
        $modulos = [
            // 1º DAM (id_curso = 1)
            [
                'codigo' => 'MP01-DAM',
                'nombre' => 'Sistemas informáticos',
                'id_curso' => 1,
                'horas_totales' => 192,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'codigo' => 'MP02-DAM',
                'nombre' => 'Bases de datos',
                'id_curso' => 1,
                'horas_totales' => 192,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'codigo' => 'MP03-DAM',
                'nombre' => 'Programación',
                'id_curso' => 1,
                'horas_totales' => 256,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // 2º DAM (id_curso = 2)
            [
                'codigo' => 'MP04-DAM',
                'nombre' => 'Desarrollo de interfaces',
                'id_curso' => 2,
                'horas_totales' => 120,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'codigo' => 'MP05-DAM',
                'nombre' => 'Acceso a datos',
                'id_curso' => 2,
                'horas_totales' => 120,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'codigo' => 'MP06-DAM',
                'nombre' => 'Formación en centros de trabajo',
                'id_curso' => 2,
                'horas_totales' => 370,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // 1º DAW (id_curso = 3)
            [
                'codigo' => 'MP01-DAW',
                'nombre' => 'Sistemas informáticos',
                'id_curso' => 3,
                'horas_totales' => 192,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'codigo' => 'MP02-DAW',
                'nombre' => 'Bases de datos',
                'id_curso' => 3,
                'horas_totales' => 192,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'codigo' => 'MP03-DAW',
                'nombre' => 'Programación',
                'id_curso' => 3,
                'horas_totales' => 256,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // 2º DAW (id_curso = 4)
            [
                'codigo' => 'MP04-DAW',
                'nombre' => 'Desarrollo web en entorno cliente',
                'id_curso' => 4,
                'horas_totales' => 140,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'codigo' => 'MP05-DAW',
                'nombre' => 'Desarrollo web en entorno servidor',
                'id_curso' => 4,
                'horas_totales' => 160,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'codigo' => 'MP06-DAW',
                'nombre' => 'Formación en centros de trabajo',
                'id_curso' => 4,
                'horas_totales' => 370,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('modulos')->insert($modulos);
    }
}

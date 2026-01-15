<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CursoSeeder extends Seeder
{
    public function run(): void
    {
        $cursos = [
            // DAM
            ['id_ciclo' => 1, 'numero_curso' => 1, 'nombre' => '1º DAM', 'created_at' => now(), 'updated_at' => now()],
            ['id_ciclo' => 1, 'numero_curso' => 2, 'nombre' => '2º DAM', 'created_at' => now(), 'updated_at' => now()],
            // DAW
            ['id_ciclo' => 2, 'numero_curso' => 1, 'nombre' => '1º DAW', 'created_at' => now(), 'updated_at' => now()],
            ['id_ciclo' => 2, 'numero_curso' => 2, 'nombre' => '2º DAW', 'created_at' => now(), 'updated_at' => now()],
            // ASIR
            ['id_ciclo' => 3, 'numero_curso' => 1, 'nombre' => '1º ASIR', 'created_at' => now(), 'updated_at' => now()],
            ['id_ciclo' => 3, 'numero_curso' => 2, 'nombre' => '2º ASIR', 'created_at' => now(), 'updated_at' => now()],
            // SMR
            ['id_ciclo' => 4, 'numero_curso' => 1, 'nombre' => '1º SMR', 'created_at' => now(), 'updated_at' => now()],
            ['id_ciclo' => 4, 'numero_curso' => 2, 'nombre' => '2º SMR', 'created_at' => now(), 'updated_at' => now()],
        ];

        DB::table('cursos')->insert($cursos);
    }
}

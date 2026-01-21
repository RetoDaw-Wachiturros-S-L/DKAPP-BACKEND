<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class IncidenciaSeeder extends Seeder
{
    public function run(): void
    {
        $incidencias = [
            [
                'id_usuario' => 1, // Admin
                'tipo' => 'MEJORA',
                'descripcion' => 'Añadir filtros avanzados en la lista de estancias formativas.',
                'estado' => 'ACTIVA',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_usuario' => 2, // María
                'tipo' => 'PROBLEMA',
                'descripcion' => 'No se muestra el tutor asignado en el detalle del alumno.',
                'estado' => 'ACTIVA',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('incidencias')->insert($incidencias);
    }
}

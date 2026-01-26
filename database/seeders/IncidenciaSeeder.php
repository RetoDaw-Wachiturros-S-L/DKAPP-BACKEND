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
                'fecha_hora' => now()->subDays(5),
                'tipo_incidencia' => 'MEJORA',
                'descripcion' => 'Añadir filtros avanzados en la lista de estancias formativas.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_usuario' => 2, // María
                'fecha_hora' => now()->subDays(2),
                'tipo_incidencia' => 'PROBLEMA',
                'descripcion' => 'No se muestra el tutor asignado en el detalle del alumno.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_usuario' => 3, // Juan
                'fecha_hora' => now()->subDay(),
                'tipo_incidencia' => 'NO FUNCIONA',
                'descripcion' => 'El botón de exportar a PDF no responde en la vista de evaluaciones.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('incidencias')->insert($incidencias);
    }
}

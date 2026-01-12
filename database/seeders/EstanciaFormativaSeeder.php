<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class EstanciaFormativaSeeder extends Seeder
{
    public function run(): void
    {
        $estancias = [
            [
                'id_alumno' => 1, // Laura Díaz (DAM)
                'id_empresa' => 1, // TechSolutions
                'id_tutor_empresa' => 4, // Carlos Rodríguez
                'id_tutor_centro' => 2, // María García
                'id_curso' => 2, // 2º DAM
                'fecha_inicio' => Carbon::now()->startOfMonth(),
                'fecha_fin' => Carbon::now()->addMonths(3)->endOfMonth(),
                'horas_totales' => 370,
                'horas_realizadas' => 120,
                'estado' => 'EN_CURSO',
                'observaciones' => 'Alumna muy aplicada, buen rendimiento en tareas de desarrollo.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_alumno' => 2, // David Jiménez (DAW)
                'id_empresa' => 2, // InnovaSoft
                'id_tutor_empresa' => 5, // Ana Fernández
                'id_tutor_centro' => 2, // María García
                'id_curso' => 4, // 2º DAW
                'fecha_inicio' => Carbon::now()->startOfMonth(),
                'fecha_fin' => Carbon::now()->addMonths(3)->endOfMonth(),
                'horas_totales' => 370,
                'horas_realizadas' => 95,
                'estado' => 'EN_CURSO',
                'observaciones' => 'Destaca en desarrollo frontend, muestra iniciativa.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_alumno' => 3, // Sara Muñoz (DAM)
                'id_empresa' => 3, // WebDev Masters
                'id_tutor_empresa' => 4, // Carlos Rodríguez (reutilizado)
                'id_tutor_centro' => 3, // Juan Martínez
                'id_curso' => 2, // 2º DAM
                'fecha_inicio' => Carbon::now()->startOfMonth(),
                'fecha_fin' => Carbon::now()->addMonths(3)->endOfMonth(),
                'horas_totales' => 370,
                'horas_realizadas' => 88,
                'estado' => 'EN_CURSO',
                'observaciones' => 'Buena adaptación al entorno laboral.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_alumno' => 4, // Miguel Rubio (ASIR)
                'id_empresa' => 4, // SysAdmin Pro
                'id_tutor_empresa' => 6, // Pedro López
                'id_tutor_centro' => 3, // Juan Martínez
                'id_curso' => 6, // 2º ASIR
                'fecha_inicio' => Carbon::now()->subMonths(4)->startOfMonth(),
                'fecha_fin' => Carbon::now()->subWeeks(2),
                'horas_totales' => 370,
                'horas_realizadas' => 370,
                'estado' => 'COMPLETADA',
                'observaciones' => 'Estancia completada con éxito. Excelente desempeño.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('estancias_formativas')->insert($estancias);
    }
}

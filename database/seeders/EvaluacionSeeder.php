<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class EvaluacionSeeder extends Seeder
{
    public function run(): void
    {
        $evaluaciones = [
            // Estancia 1 - Laura (2º DAM) - Módulo FCT
            [
                'id_estancia' => 1,
                'id_modulo' => 6, // MP06-DAM (FCT)
                'nota_previa' => 7.85,
                'nota_competencias_tecnicas' => 8.50,
                'nota_competencias_transversales' => 9.00,
                'nota_cuaderno' => 8.00,
                'nota_fct_calculada' => 8.50, // (8.50 + 9.00 + 8.00) / 3
                'nota_final' => 8.02, // (7.85 * 0.8) + (8.50 * 0.2)
                'observaciones' => 'Excelente desempeño en las prácticas. Destaca en trabajo en equipo y comunicación.',
                'fecha_evaluacion' => Carbon::now()->subDays(5),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            
            // Estancia 2 - David (2º DAW) - Módulo FCT
            [
                'id_estancia' => 2,
                'id_modulo' => 12, // MP06-DAW (FCT)
                'nota_previa' => 8.20,
                'nota_competencias_tecnicas' => 9.00,
                'nota_competencias_transversales' => 8.50,
                'nota_cuaderno' => 7.50,
                'nota_fct_calculada' => 8.33, // (9.00 + 8.50 + 7.50) / 3
                'nota_final' => 8.23, // (8.20 * 0.8) + (8.33 * 0.2)
                'observaciones' => 'Muy buen nivel técnico. Gran capacidad de aprendizaje en nuevas tecnologías.',
                'fecha_evaluacion' => Carbon::now()->subDays(3),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            
            // Estancia 3 - Sara (2º DAM) - Módulo FCT
            [
                'id_estancia' => 3,
                'id_modulo' => 6, // MP06-DAM (FCT)
                'nota_previa' => 7.50,
                'nota_competencias_tecnicas' => 7.50,
                'nota_competencias_transversales' => 8.00,
                'nota_cuaderno' => 8.50,
                'nota_fct_calculada' => 8.00, // (7.50 + 8.00 + 8.50) / 3
                'nota_final' => 7.60, // (7.50 * 0.8) + (8.00 * 0.2)
                'observaciones' => 'Buen rendimiento general. Muestra iniciativa y autonomía en el trabajo.',
                'fecha_evaluacion' => Carbon::now()->subDays(2),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            
            // Estancia 4 - Miguel (2º ASIR) - Módulo FCT (completada)
            // Nota: Usaremos id_modulo 6 como placeholder ya que no tenemos módulos de ASIR creados
            [
                'id_estancia' => 4,
                'id_modulo' => 6, // Placeholder - debería ser FCT de ASIR
                'nota_previa' => 8.75,
                'nota_competencias_tecnicas' => 9.50,
                'nota_competencias_transversales' => 9.00,
                'nota_cuaderno' => 9.00,
                'nota_fct_calculada' => 9.17, // (9.50 + 9.00 + 9.00) / 3
                'nota_final' => 8.83, // (8.75 * 0.8) + (9.17 * 0.2)
                'observaciones' => 'Excelente alumno. Superó todas las expectativas. Alta capacidad técnica y gran profesionalidad.',
                'fecha_evaluacion' => Carbon::now()->subWeeks(2),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('evaluaciones')->insert($evaluaciones);
    }
}

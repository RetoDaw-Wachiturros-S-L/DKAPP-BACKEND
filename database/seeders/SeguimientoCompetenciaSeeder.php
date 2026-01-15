<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class SeguimientoCompetenciaSeeder extends Seeder
{
    public function run(): void
    {
        $seguimientos = [];
        
        // Estancia 1 - Laura (12 semanas)
        // Primeras 4 semanas: Competencias técnicas básicas
        for ($semana = 1; $semana <= 4; $semana++) {
            $seguimientos[] = [
                'id_estancia' => 1,
                'id_competencia' => 1, // POO
                'numero_semana' => $semana,
                'fecha_inicio' => Carbon::now()->startOfMonth()->addWeeks($semana - 1),
                'fecha_fin' => Carbon::now()->startOfMonth()->addWeeks($semana)->subDay(),
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        
        // Semanas 5-8: Interfaces y BBDD
        for ($semana = 5; $semana <= 8; $semana++) {
            $seguimientos[] = [
                'id_estancia' => 1,
                'id_competencia' => 2, // Interfaces
                'numero_semana' => $semana,
                'fecha_inicio' => Carbon::now()->startOfMonth()->addWeeks($semana - 1),
                'fecha_fin' => Carbon::now()->startOfMonth()->addWeeks($semana)->subDay(),
                'created_at' => now(),
                'updated_at' => now(),
            ];
            $seguimientos[] = [
                'id_estancia' => 1,
                'id_competencia' => 3, // BBDD
                'numero_semana' => $semana,
                'fecha_inicio' => Carbon::now()->startOfMonth()->addWeeks($semana - 1),
                'fecha_fin' => Carbon::now()->startOfMonth()->addWeeks($semana)->subDay(),
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        
        // Semanas 9-12: Competencias transversales y personales
        for ($semana = 9; $semana <= 12; $semana++) {
            $seguimientos[] = [
                'id_estancia' => 1,
                'id_competencia' => 6, // Trabajo en equipo
                'numero_semana' => $semana,
                'fecha_inicio' => Carbon::now()->startOfMonth()->addWeeks($semana - 1),
                'fecha_fin' => Carbon::now()->startOfMonth()->addWeeks($semana)->subDay(),
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        
        // Estancia 2 - David (12 semanas - DAW)
        for ($semana = 1; $semana <= 6; $semana++) {
            $seguimientos[] = [
                'id_estancia' => 2,
                'id_competencia' => 4, // Servicios web
                'numero_semana' => $semana,
                'fecha_inicio' => Carbon::now()->startOfMonth()->addWeeks($semana - 1),
                'fecha_fin' => Carbon::now()->startOfMonth()->addWeeks($semana)->subDay(),
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        
        for ($semana = 7; $semana <= 12; $semana++) {
            $seguimientos[] = [
                'id_estancia' => 2,
                'id_competencia' => 2, // Interfaces
                'numero_semana' => $semana,
                'fecha_inicio' => Carbon::now()->startOfMonth()->addWeeks($semana - 1),
                'fecha_fin' => Carbon::now()->startOfMonth()->addWeeks($semana)->subDay(),
                'created_at' => now(),
                'updated_at' => now(),
            ];
            $seguimientos[] = [
                'id_estancia' => 2,
                'id_competencia' => 7, // Comunicación
                'numero_semana' => $semana,
                'fecha_inicio' => Carbon::now()->startOfMonth()->addWeeks($semana - 1),
                'fecha_fin' => Carbon::now()->startOfMonth()->addWeeks($semana)->subDay(),
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        
        // Estancia 3 - Sara (12 semanas)
        for ($semana = 1; $semana <= 12; $semana++) {
            $seguimientos[] = [
                'id_estancia' => 3,
                'id_competencia' => 1, // POO
                'numero_semana' => $semana,
                'fecha_inicio' => Carbon::now()->startOfMonth()->addWeeks($semana - 1),
                'fecha_fin' => Carbon::now()->startOfMonth()->addWeeks($semana)->subDay(),
                'created_at' => now(),
                'updated_at' => now(),
            ];
            
            if ($semana > 6) {
                $seguimientos[] = [
                    'id_estancia' => 3,
                    'id_competencia' => 11, // Iniciativa
                    'numero_semana' => $semana,
                    'fecha_inicio' => Carbon::now()->startOfMonth()->addWeeks($semana - 1),
                    'fecha_fin' => Carbon::now()->startOfMonth()->addWeeks($semana)->subDay(),
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
        }

        DB::table('seguimiento_competencias')->insert($seguimientos);
    }
}

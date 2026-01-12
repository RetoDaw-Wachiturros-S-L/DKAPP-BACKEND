<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ModuloCompetenciaSeeder extends Seeder
{
    public function run(): void
    {
        $relaciones = [
            // MP03-DAM (Programación) - competencias técnicas básicas
            ['id_modulo' => 3, 'id_competencia' => 1, 'created_at' => now()], // POO
            ['id_modulo' => 3, 'id_competencia' => 5, 'created_at' => now()], // Control versiones
            ['id_modulo' => 3, 'id_competencia' => 6, 'created_at' => now()], // Trabajo equipo
            ['id_modulo' => 3, 'id_competencia' => 8, 'created_at' => now()], // Resolución problemas
            
            // MP02-DAM (Bases de datos)
            ['id_modulo' => 2, 'id_competencia' => 3, 'created_at' => now()], // Gestión BBDD
            ['id_modulo' => 2, 'id_competencia' => 8, 'created_at' => now()], // Resolución problemas
            
            // MP04-DAM (Desarrollo interfaces)
            ['id_modulo' => 4, 'id_competencia' => 2, 'created_at' => now()], // Desarrollo interfaces
            ['id_modulo' => 4, 'id_competencia' => 1, 'created_at' => now()], // POO
            ['id_modulo' => 4, 'id_competencia' => 11, 'created_at' => now()], // Iniciativa
            
            // MP05-DAM (Acceso a datos)
            ['id_modulo' => 5, 'id_competencia' => 3, 'created_at' => now()], // Gestión BBDD
            ['id_modulo' => 5, 'id_competencia' => 1, 'created_at' => now()], // POO
            
            // MP06-DAM (FCT)
            ['id_modulo' => 6, 'id_competencia' => 1, 'created_at' => now()],
            ['id_modulo' => 6, 'id_competencia' => 2, 'created_at' => now()],
            ['id_modulo' => 6, 'id_competencia' => 3, 'created_at' => now()],
            ['id_modulo' => 6, 'id_competencia' => 6, 'created_at' => now()], // Trabajo equipo
            ['id_modulo' => 6, 'id_competencia' => 7, 'created_at' => now()], // Comunicación
            ['id_modulo' => 6, 'id_competencia' => 9, 'created_at' => now()], // Adaptabilidad
            ['id_modulo' => 6, 'id_competencia' => 10, 'created_at' => now()], // Responsabilidad
            ['id_modulo' => 6, 'id_competencia' => 11, 'created_at' => now()], // Iniciativa
            ['id_modulo' => 6, 'id_competencia' => 12, 'created_at' => now()], // Gestión tiempo
            
            // MP03-DAW (Programación)
            ['id_modulo' => 9, 'id_competencia' => 1, 'created_at' => now()], // POO
            ['id_modulo' => 9, 'id_competencia' => 5, 'created_at' => now()], // Control versiones
            
            // MP04-DAW (Cliente)
            ['id_modulo' => 10, 'id_competencia' => 2, 'created_at' => now()], // Interfaces
            ['id_modulo' => 10, 'id_competencia' => 4, 'created_at' => now()], // Servicios web
            
            // MP05-DAW (Servidor)
            ['id_modulo' => 11, 'id_competencia' => 4, 'created_at' => now()], // Servicios web
            ['id_modulo' => 11, 'id_competencia' => 3, 'created_at' => now()], // BBDD
            
            // MP06-DAW (FCT)
            ['id_modulo' => 12, 'id_competencia' => 1, 'created_at' => now()],
            ['id_modulo' => 12, 'id_competencia' => 2, 'created_at' => now()],
            ['id_modulo' => 12, 'id_competencia' => 3, 'created_at' => now()],
            ['id_modulo' => 12, 'id_competencia' => 4, 'created_at' => now()],
            ['id_modulo' => 12, 'id_competencia' => 6, 'created_at' => now()],
            ['id_modulo' => 12, 'id_competencia' => 7, 'created_at' => now()],
            ['id_modulo' => 12, 'id_competencia' => 9, 'created_at' => now()],
            ['id_modulo' => 12, 'id_competencia' => 10, 'created_at' => now()],
            ['id_modulo' => 12, 'id_competencia' => 11, 'created_at' => now()],
            ['id_modulo' => 12, 'id_competencia' => 12, 'created_at' => now()],
        ];

        DB::table('modulo_competencia')->insert($relaciones);
    }
}

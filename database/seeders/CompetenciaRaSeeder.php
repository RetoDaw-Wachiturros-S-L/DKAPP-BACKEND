<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CompetenciaRaSeeder extends Seeder
{
    public function run(): void
    {
        $relaciones = [
            // CT-01 (Programación OO) relacionada con RAs de DAM
            ['id_competencia' => 1, 'id_ra' => 1, 'created_at' => now()],
            ['id_competencia' => 1, 'id_ra' => 2, 'created_at' => now()],
            
            // CT-02 (Desarrollo interfaces) relacionada con RA de interfaces
            ['id_competencia' => 2, 'id_ra' => 4, 'created_at' => now()],
            
            // CT-03 (Gestión BBDD) relacionada con RAs de BBDD
            ['id_competencia' => 3, 'id_ra' => 3, 'created_at' => now()],
            
            // CT-04 (Servicios web) relacionada con RAs de DAW
            ['id_competencia' => 4, 'id_ra' => 5, 'created_at' => now()],
            ['id_competencia' => 4, 'id_ra' => 6, 'created_at' => now()],
            ['id_competencia' => 4, 'id_ra' => 7, 'created_at' => now()],
            
            // CT-05 (Control versiones) relacionada con varios RAs
            ['id_competencia' => 5, 'id_ra' => 1, 'created_at' => now()],
            ['id_competencia' => 5, 'id_ra' => 5, 'created_at' => now()],
            
            // Competencias transversales aplicables a todos
            ['id_competencia' => 6, 'id_ra' => 1, 'created_at' => now()], // Trabajo en equipo
            ['id_competencia' => 7, 'id_ra' => 1, 'created_at' => now()], // Comunicación
            ['id_competencia' => 8, 'id_ra' => 3, 'created_at' => now()], // Resolución problemas
            ['id_competencia' => 9, 'id_ra' => 8, 'created_at' => now()], // Adaptabilidad
            
            // Competencias personales
            ['id_competencia' => 10, 'id_ra' => 1, 'created_at' => now()], // Responsabilidad
            ['id_competencia' => 11, 'id_ra' => 2, 'created_at' => now()], // Iniciativa
            ['id_competencia' => 12, 'id_ra' => 1, 'created_at' => now()], // Gestión tiempo
        ];

        DB::table('competencia_ra')->insert($relaciones);
    }
}

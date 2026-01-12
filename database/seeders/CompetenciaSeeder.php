<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CompetenciaSeeder extends Seeder
{
    public function run(): void
    {
        $competencias = [
            // Competencias Técnicas
            [
                'codigo' => 'CT-01',
                'descripcion' => 'Programación orientada a objetos',
                'tipo' => 'TECNICA',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'codigo' => 'CT-02',
                'descripcion' => 'Desarrollo de interfaces de usuario',
                'tipo' => 'TECNICA',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'codigo' => 'CT-03',
                'descripcion' => 'Gestión de bases de datos',
                'tipo' => 'TECNICA',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'codigo' => 'CT-04',
                'descripcion' => 'Desarrollo de servicios web',
                'tipo' => 'TECNICA',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'codigo' => 'CT-05',
                'descripcion' => 'Control de versiones y metodologías ágiles',
                'tipo' => 'TECNICA',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Competencias Transversales
            [
                'codigo' => 'CTR-01',
                'descripcion' => 'Trabajo en equipo',
                'tipo' => 'TRANSVERSAL',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'codigo' => 'CTR-02',
                'descripcion' => 'Comunicación efectiva',
                'tipo' => 'TRANSVERSAL',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'codigo' => 'CTR-03',
                'descripcion' => 'Resolución de problemas',
                'tipo' => 'TRANSVERSAL',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'codigo' => 'CTR-04',
                'descripcion' => 'Adaptabilidad al cambio',
                'tipo' => 'TRANSVERSAL',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Competencias Personales
            [
                'codigo' => 'CP-01',
                'descripcion' => 'Responsabilidad y compromiso',
                'tipo' => 'PERSONAL',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'codigo' => 'CP-02',
                'descripcion' => 'Iniciativa y autonomía',
                'tipo' => 'PERSONAL',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'codigo' => 'CP-03',
                'descripcion' => 'Gestión del tiempo',
                'tipo' => 'PERSONAL',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('competencias')->insert($competencias);
    }
}

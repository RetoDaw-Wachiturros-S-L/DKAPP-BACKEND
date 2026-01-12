<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CicloSeeder extends Seeder
{
    public function run(): void
    {
        $ciclos = [
            [
                'codigo' => 'DAM',
                'nombre' => 'Desarrollo de Aplicaciones Multiplataforma',
                'nivel' => 2,
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'codigo' => 'DAW',
                'nombre' => 'Desarrollo de Aplicaciones Web',
                'nivel' => 2,
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'codigo' => 'ASIR',
                'nombre' => 'Administración de Sistemas Informáticos en Red',
                'nivel' => 2,
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'codigo' => 'SMR',
                'nombre' => 'Sistemas Microinformáticos y Redes',
                'nivel' => 1,
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('ciclos')->insert($ciclos);
    }
}

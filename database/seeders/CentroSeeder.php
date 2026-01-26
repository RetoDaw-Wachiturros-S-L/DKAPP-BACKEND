<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CentroSeeder extends Seeder
{
    public function run(): void
    {
        $centros = [
            [
                'nombre' => 'Egibide Arriaga',
                'codigo_centro' => 'EGI-ARR',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Egibide Jesús Obrero',
                'codigo_centro' => 'EGI-JOB',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Egibide Nieves Cano',
                'codigo_centro' => 'EGI-NCA',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('centros')->insert($centros);
    }
}

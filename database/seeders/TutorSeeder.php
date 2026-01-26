<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TutorSeeder extends Seeder
{
    public function run(): void
    {
        // Obtener el ID del primer centro (Egibide Arriaga)
        $centroId = DB::table('centros')->where('codigo_centro', 'EGI-ARR')->value('id');

        $tutores = [
            [
                'id_user' => 2, // María García López
                'dni' => '11111111A',
                'es_de_egibide' => true,
                'poblacion' => 'Vitoria-Gasteiz',
                'id_centro' => $centroId,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_user' => 3, // Juan Martínez Sánchez
                'dni' => '22222222B',
                'es_de_egibide' => true,
                'poblacion' => 'Vitoria-Gasteiz',
                'id_centro' => $centroId,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('tutores')->insert($tutores);
    }
}

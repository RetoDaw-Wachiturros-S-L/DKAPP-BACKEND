<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LogSeeder extends Seeder
{
    public function run(): void
    {
        $logs = [
            [
                'id_usuario' => 1,
                'nivel' => 'INFO',
                'tipo' => 'seed',
                'mensaje' => 'Seed inicial ejecutado correctamente.',
                'contexto' => json_encode(['source' => 'DatabaseSeeder']),
                'tabla_afectada' => null,
                'registro_id' => null,
                'ip' => '127.0.0.1',
                'user_agent' => 'Seeder',
                'url' => null,
                'metodo_http' => null,
                'created_at' => now(),
            ],
            [
                'id_usuario' => 2,
                'nivel' => 'INFO',
                'tipo' => 'estancia',
                'mensaje' => 'Tutor asignado a estancia formativa.',
                'contexto' => json_encode(['action' => 'assign_tutor']),
                'tabla_afectada' => 'estancias_formativas',
                'registro_id' => 1,
                'ip' => '127.0.0.1',
                'user_agent' => 'Seeder',
                'url' => null,
                'metodo_http' => null,
                'created_at' => now(),
            ],
        ];

        DB::table('logs')->insert($logs);
    }
}

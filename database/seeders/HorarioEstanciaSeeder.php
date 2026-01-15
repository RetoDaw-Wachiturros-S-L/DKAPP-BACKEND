<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HorarioEstanciaSeeder extends Seeder
{
    public function run(): void
    {
        $horarios = [
            // Estancia 1 - Laura (Horario continuo mañana-tarde)
            [
                'id_estancia' => 1,
                'dia_semana' => 'LUNES',
                'turno' => 'CONTINUO',
                'hora_inicio' => '09:00:00',
                'hora_fin' => '17:00:00',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_estancia' => 1,
                'dia_semana' => 'MARTES',
                'turno' => 'CONTINUO',
                'hora_inicio' => '09:00:00',
                'hora_fin' => '17:00:00',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_estancia' => 1,
                'dia_semana' => 'MIERCOLES',
                'turno' => 'CONTINUO',
                'hora_inicio' => '09:00:00',
                'hora_fin' => '17:00:00',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_estancia' => 1,
                'dia_semana' => 'JUEVES',
                'turno' => 'CONTINUO',
                'hora_inicio' => '09:00:00',
                'hora_fin' => '17:00:00',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_estancia' => 1,
                'dia_semana' => 'VIERNES',
                'turno' => 'CONTINUO',
                'hora_inicio' => '09:00:00',
                'hora_fin' => '14:00:00',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            
            // Estancia 2 - David (Solo mañanas)
            [
                'id_estancia' => 2,
                'dia_semana' => 'LUNES',
                'turno' => 'MAÑANA',
                'hora_inicio' => '08:30:00',
                'hora_fin' => '14:30:00',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_estancia' => 2,
                'dia_semana' => 'MARTES',
                'turno' => 'MAÑANA',
                'hora_inicio' => '08:30:00',
                'hora_fin' => '14:30:00',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_estancia' => 2,
                'dia_semana' => 'MIERCOLES',
                'turno' => 'MAÑANA',
                'hora_inicio' => '08:30:00',
                'hora_fin' => '14:30:00',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_estancia' => 2,
                'dia_semana' => 'JUEVES',
                'turno' => 'MAÑANA',
                'hora_inicio' => '08:30:00',
                'hora_fin' => '14:30:00',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_estancia' => 2,
                'dia_semana' => 'VIERNES',
                'turno' => 'MAÑANA',
                'hora_inicio' => '08:30:00',
                'hora_fin' => '14:30:00',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            
            // Estancia 3 - Sara (Horario partido)
            [
                'id_estancia' => 3,
                'dia_semana' => 'LUNES',
                'turno' => 'MAÑANA',
                'hora_inicio' => '09:00:00',
                'hora_fin' => '13:00:00',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_estancia' => 3,
                'dia_semana' => 'LUNES',
                'turno' => 'TARDE',
                'hora_inicio' => '15:00:00',
                'hora_fin' => '19:00:00',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_estancia' => 3,
                'dia_semana' => 'MARTES',
                'turno' => 'MAÑANA',
                'hora_inicio' => '09:00:00',
                'hora_fin' => '13:00:00',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_estancia' => 3,
                'dia_semana' => 'MARTES',
                'turno' => 'TARDE',
                'hora_inicio' => '15:00:00',
                'hora_fin' => '19:00:00',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_estancia' => 3,
                'dia_semana' => 'MIERCOLES',
                'turno' => 'MAÑANA',
                'hora_inicio' => '09:00:00',
                'hora_fin' => '13:00:00',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_estancia' => 3,
                'dia_semana' => 'JUEVES',
                'turno' => 'MAÑANA',
                'hora_inicio' => '09:00:00',
                'hora_fin' => '13:00:00',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_estancia' => 3,
                'dia_semana' => 'VIERNES',
                'turno' => 'MAÑANA',
                'hora_inicio' => '09:00:00',
                'hora_fin' => '13:00:00',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('horarios_estancia')->insert($horarios);
    }
}

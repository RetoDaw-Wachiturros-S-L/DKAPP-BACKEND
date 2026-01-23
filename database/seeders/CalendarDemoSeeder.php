<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CalendarDemoSeeder extends Seeder
{
    public function run(): void
    {
        // Tomar una estancia existente para demo
        $estancia = DB::table('estancias_formativas')->orderBy('id')->first();
        if (!$estancia) {
            $this->command->warn('No hay estancias_formativas; omito CalendarDemoSeeder.');
            return;
        }

        $estanciaId = $estancia->id;
        $alumnoId = $estancia->id_alumno;

        // Añadir vacaciones (rango) y día libre como notas de seguimiento
        $vacacionesFechaInicio = Carbon::now()->addWeeks(1)->startOfWeek();
        $vacacionesFechaFin = Carbon::now()->addWeeks(1)->endOfWeek();

        DB::table('notas_seguimiento')->insert([
            [
                'id_estancia' => $estanciaId,
                'id_alumno' => $alumnoId,
                'fecha' => $vacacionesFechaInicio->toDateString(),
                'accion' => 'VACACIONES',
                'contenido' => 'Vacaciones programadas (semana completa)',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_estancia' => $estanciaId,
                'id_alumno' => $alumnoId,
                'fecha' => Carbon::now()->addDays(3)->toDateString(),
                'accion' => 'DIA_LIBRE',
                'contenido' => 'Día libre por asuntos personales',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        // Añadir un horario en sábado para visualizar días de fin de semana
        DB::table('horarios_estancia')->insert([
            [
                'id_estancia' => $estanciaId,
                'dia_semana' => 'SABADO',
                'turno' => 'MAÑANA',
                'hora_inicio' => '09:00:00',
                'hora_fin' => '12:00:00',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        $this->command->info("CalendarDemoSeeder: notas VACACIONES/DIA_LIBRE y horario de SÁBADO añadidos para estancia ID {$estanciaId}.");
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class NotaSeguimientoSeeder extends Seeder
{
    public function run(): void
    {
        $notas = [
            // Estancia 1 - Laura
            [
                'id_estancia' => 1,
                'id_alumno' => 1,
                'fecha' => Carbon::now()->startOfMonth(),
                'accion' => 'PRESENTACION_ALUMNO',
                'contenido' => 'Primera presentación de Laura en TechSolutions. Se presentó al equipo y recibió material de trabajo.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_estancia' => 1,
                'id_alumno' => 1,
                'fecha' => Carbon::now()->startOfMonth()->addWeeks(2),
                'accion' => 'LLAMADA_SEGUIMIENTO',
                'contenido' => 'Llamada con el tutor de empresa. Laura está adaptándose bien y muestra gran interés.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_estancia' => 1,
                'id_alumno' => 1,
                'fecha' => Carbon::now()->subDays(5),
                'accion' => 'VISITA_CENTRO_TRABAJO',
                'contenido' => 'Visita al centro de trabajo. Se comprobó el buen ambiente laboral y el progreso de Laura en sus tareas.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            
            // Estancia 2 - David
            [
                'id_estancia' => 2,
                'id_alumno' => 2,
                'fecha' => Carbon::now()->startOfMonth(),
                'accion' => 'PRESENTACION_ALUMNO',
                'contenido' => 'David se incorporó a InnovaSoft. Asignado al equipo de desarrollo frontend.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_estancia' => 2,
                'id_alumno' => 2,
                'fecha' => Carbon::now()->startOfMonth()->addWeeks(1),
                'accion' => 'LLAMADA_SEGUIMIENTO',
                'contenido' => 'Primera llamada de seguimiento. David comenta que el ritmo es exigente pero está aprendiendo mucho.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_estancia' => 2,
                'id_alumno' => 2,
                'fecha' => Carbon::now()->subDays(3),
                'accion' => 'REUNION_TUTOR_PRACTICAS',
                'contenido' => 'Reunión con el tutor de prácticas. Evaluación positiva del desempeño de David.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            
            // Estancia 3 - Sara
            [
                'id_estancia' => 3,
                'id_alumno' => 3,
                'fecha' => Carbon::now()->startOfMonth(),
                'accion' => 'PRESENTACION_ALUMNO',
                'contenido' => 'Sara comienza sus prácticas en WebDev Masters. Mostró entusiasmo desde el primer día.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_estancia' => 3,
                'id_alumno' => 3,
                'fecha' => Carbon::now()->startOfMonth()->addDays(10),
                'accion' => 'INCIDENCIA',
                'contenido' => 'Sara tuvo problemas de acceso al sistema. Se resolvió en el mismo día.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            
            // Estancia 4 - Miguel (completada)
            [
                'id_estancia' => 4,
                'id_alumno' => 4,
                'fecha' => Carbon::now()->subMonths(4)->startOfMonth(),
                'accion' => 'PRESENTACION_ALUMNO',
                'contenido' => 'Miguel inició sus prácticas en SysAdmin Pro. Área de administración de sistemas.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_estancia' => 4,
                'id_alumno' => 4,
                'fecha' => Carbon::now()->subMonths(3),
                'accion' => 'VISITA_CENTRO_TRABAJO',
                'contenido' => 'Visita al centro de trabajo. Miguel trabajando en tareas de administración de servidores Linux.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_estancia' => 4,
                'id_alumno' => 4,
                'fecha' => Carbon::now()->subMonths(2),
                'accion' => 'LLAMADA_SEGUIMIENTO',
                'contenido' => 'Seguimiento telefónico. Miguel destaca por su autonomía y capacidad resolutiva.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_estancia' => 4,
                'id_alumno' => 4,
                'fecha' => Carbon::now()->subWeeks(2),
                'accion' => 'EVALUACION',
                'contenido' => 'Evaluación final muy positiva. Miguel completó todas las tareas asignadas con excelente calidad.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('notas_seguimiento')->insert($notas);
    }
}

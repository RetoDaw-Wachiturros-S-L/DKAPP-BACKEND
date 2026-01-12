<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Orden de ejecución de seeders respetando dependencias de claves foráneas
        
        // 1. Tablas base sin dependencias
        $this->call([
            UserSeeder::class,           // Usuarios (necesario para alumnos y tutores)
            CicloSeeder::class,          // Ciclos formativos
        ]);

        // 2. Tablas que dependen de ciclos
        $this->call([
            CursoSeeder::class,          // Cursos (depende de ciclos)
            ResultadoAprendizajeSeeder::class, // RAs (depende de ciclos)
            CompetenciaSeeder::class,    // Competencias (independiente)
        ]);

        // 3. Tablas que dependen de cursos
        $this->call([
            ModuloSeeder::class,         // Módulos (depende de cursos)
        ]);

        // 4. Tablas relacionales entre competencias/RAs/módulos
        $this->call([
            CompetenciaRaSeeder::class,  // Relación competencias-RAs
            ModuloCompetenciaSeeder::class, // Relación módulos-competencias
        ]);

        // 5. Gestión de alumnos y empresas
        $this->call([
            AlumnoSeeder::class,         // Alumnos (depende de users y ciclos)
            EmpresaSeeder::class,        // Empresas (independiente)
            ContactoEmpresaSeeder::class, // Contactos (depende de empresas)
        ]);

        // 6. Estancias formativas y seguimiento
        $this->call([
            EstanciaFormativaSeeder::class, // Estancias (depende de alumnos, empresas, users, cursos)
            HorarioEstanciaSeeder::class,   // Horarios (depende de estancias)
            NotaSeguimientoSeeder::class,   // Notas de seguimiento (depende de estancias y alumnos)
            SeguimientoCompetenciaSeeder::class, // Seguimiento competencias (depende de estancias y competencias)
            EvaluacionSeeder::class,        // Evaluaciones (depende de estancias y módulos)
        ]);

        $this->command->info('✅ Base de datos poblada correctamente con datos de ejemplo');
    }
}

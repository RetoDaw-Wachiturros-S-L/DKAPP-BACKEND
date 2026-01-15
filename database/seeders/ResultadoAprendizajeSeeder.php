<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ResultadoAprendizajeSeeder extends Seeder
{
    public function run(): void
    {
        $resultados = [
            // DAM (id_ciclo = 1)
            [
                'codigo' => 'RA-DAM-01',
                'descripcion' => 'Reconoce los elementos y herramientas que intervienen en el desarrollo de un programa informático, analizando sus características y las fases en las que actúan',
                'id_ciclo' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'codigo' => 'RA-DAM-02',
                'descripcion' => 'Escribe y prueba programas sencillos, reconociendo y aplicando los fundamentos de la programación orientada a objetos',
                'id_ciclo' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'codigo' => 'RA-DAM-03',
                'descripcion' => 'Desarrolla aplicaciones con acceso a bases de datos, utilizando conectores y herramientas específicas',
                'id_ciclo' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'codigo' => 'RA-DAM-04',
                'descripcion' => 'Genera interfaces gráficos de usuario mediante el uso de librerías de clases',
                'id_ciclo' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // DAW (id_ciclo = 2)
            [
                'codigo' => 'RA-DAW-01',
                'descripcion' => 'Programa páginas web dinámicas interpretadas en el cliente web, utilizando lenguajes de marcas y de guiones',
                'id_ciclo' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'codigo' => 'RA-DAW-02',
                'descripcion' => 'Desarrolla aplicaciones web embebidas en lenguajes de marcas, analizando e incorporando funcionalidades',
                'id_ciclo' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'codigo' => 'RA-DAW-03',
                'descripcion' => 'Desarrolla aplicaciones Web identificando y aplicando mecanismos para separar el código de presentación de la lógica de negocio',
                'id_ciclo' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // ASIR (id_ciclo = 3)
            [
                'codigo' => 'RA-ASIR-01',
                'descripcion' => 'Instala y configura sistemas operativos en red, describiendo sus características e interpretando la documentación técnica',
                'id_ciclo' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'codigo' => 'RA-ASIR-02',
                'descripcion' => 'Administra usuarios y grupos de sistemas operativos en red, interpretando especificaciones y aplicando herramientas del sistema',
                'id_ciclo' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'codigo' => 'RA-ASIR-03',
                'descripcion' => 'Gestiona servicios de red mediante protocolos y configuración de servidores',
                'id_ciclo' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('resultados_aprendizaje')->insert($resultados);
    }
}

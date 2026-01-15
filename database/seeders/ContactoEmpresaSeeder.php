<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ContactoEmpresaSeeder extends Seeder
{
    public function run(): void
    {
        $contactos = [
            // TechSolutions
            [
                'id_empresa' => 1,
                'nombre' => 'Carlos',
                'apellidos' => 'Rodríguez Pérez',
                'email' => 'carlos.rodriguez@techsolutions.es',
                'telefono' => '666456789',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_empresa' => 1,
                'nombre' => 'Elena',
                'apellidos' => 'Sánchez Martín',
                'email' => 'elena.sanchez@techsolutions.es',
                'telefono' => '666567891',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // InnovaSoft
            [
                'id_empresa' => 2,
                'nombre' => 'Ana',
                'apellidos' => 'Fernández Ruiz',
                'email' => 'ana.fernandez@innovasoft.com',
                'telefono' => '666567890',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_empresa' => 2,
                'nombre' => 'Roberto',
                'apellidos' => 'Gómez Díaz',
                'email' => 'roberto.gomez@innovasoft.com',
                'telefono' => '666678902',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // WebDev Masters
            [
                'id_empresa' => 3,
                'nombre' => 'Patricia',
                'apellidos' => 'López Herrera',
                'email' => 'patricia.lopez@webdevmasters.es',
                'telefono' => '666789013',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // SysAdmin Pro
            [
                'id_empresa' => 4,
                'nombre' => 'Pedro',
                'apellidos' => 'López García',
                'email' => 'pedro.lopez@sysadminpro.es',
                'telefono' => '666678901',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('contactos_empresa')->insert($contactos);
    }
}

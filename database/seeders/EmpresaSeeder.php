<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmpresaSeeder extends Seeder
{
    public function run(): void
    {
        $empresas = [
            [
                'nombre' => 'TechSolutions S.L.',
                'cif' => 'B12345678',
                'direccion' => 'Calle Gran Vía, 45',
                'localidad' => 'Madrid',
                'provincia' => 'Madrid',
                'codigo_postal' => '28013',
                'telefono' => '912345678',
                'email' => 'contacto@techsolutions.es',
                'estado' => 'ACTIVA',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'InnovaSoft Technologies',
                'cif' => 'B23456789',
                'direccion' => 'Paseo de Gracia, 100',
                'localidad' => 'Barcelona',
                'provincia' => 'Barcelona',
                'codigo_postal' => '08008',
                'telefono' => '934567890',
                'email' => 'info@innovasoft.com',
                'estado' => 'ACTIVA',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'WebDev Masters',
                'cif' => 'B34567890',
                'direccion' => 'Avenida del Puerto, 23',
                'localidad' => 'Valencia',
                'provincia' => 'Valencia',
                'codigo_postal' => '46021',
                'telefono' => '963456789',
                'email' => 'contacto@webdevmasters.es',
                'estado' => 'ACTIVA',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'SysAdmin Pro',
                'cif' => 'B45678901',
                'direccion' => 'Calle Sierpes, 67',
                'localidad' => 'Sevilla',
                'provincia' => 'Sevilla',
                'codigo_postal' => '41004',
                'telefono' => '954123456',
                'email' => 'info@sysadminpro.es',
                'estado' => 'ACTIVA',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('empresas')->insert($empresas);
    }
}

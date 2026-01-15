<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            // Admin
            [
                'nombre' => 'Admin',
                'apellidos' => 'Sistema',
                'email' => 'admin@dkapp.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password123'),
                'rol' => 'ADMIN',
                'telefono' => '666123456',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Tutores Centro
            [
                'nombre' => 'María',
                'apellidos' => 'García López',
                'email' => 'maria.garcia@dkapp.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password123'),
                'rol' => 'TUTOR_CENTRO',
                'telefono' => '666234567',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Juan',
                'apellidos' => 'Martínez Sánchez',
                'email' => 'juan.martinez@dkapp.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password123'),
                'rol' => 'TUTOR_CENTRO',
                'telefono' => '666345678',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Tutores Empresa
            [
                'nombre' => 'Carlos',
                'apellidos' => 'Rodríguez Pérez',
                'email' => 'carlos.rodriguez@empresa1.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password123'),
                'rol' => 'TUTOR_EMPRESA',
                'telefono' => '666456789',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Ana',
                'apellidos' => 'Fernández Ruiz',
                'email' => 'ana.fernandez@empresa2.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password123'),
                'rol' => 'TUTOR_EMPRESA',
                'telefono' => '666567890',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Pedro',
                'apellidos' => 'López García',
                'email' => 'pedro.lopez@empresa3.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password123'),
                'rol' => 'TUTOR_EMPRESA',
                'telefono' => '666678901',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Alumnos
            [
                'nombre' => 'Laura',
                'apellidos' => 'Díaz Moreno',
                'email' => 'laura.diaz@alumno.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password123'),
                'rol' => 'ALUMNO',
                'telefono' => '666789012',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'David',
                'apellidos' => 'Jiménez Castro',
                'email' => 'david.jimenez@alumno.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password123'),
                'rol' => 'ALUMNO',
                'telefono' => '666890123',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Sara',
                'apellidos' => 'Muñoz Torres',
                'email' => 'sara.munoz@alumno.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password123'),
                'rol' => 'ALUMNO',
                'telefono' => '666901234',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Miguel Ángel',
                'apellidos' => 'Rubio Vega',
                'email' => 'miguel.rubio@alumno.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password123'),
                'rol' => 'ALUMNO',
                'telefono' => '666012345',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('users')->insert($users);
    }
}

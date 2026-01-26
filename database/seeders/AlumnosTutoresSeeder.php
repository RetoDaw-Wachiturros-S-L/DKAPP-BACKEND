<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AlumnosTutoresSeeder extends Seeder
{
    public function run(): void
    {
        $mariaTutorId = DB::table('tutores')->where('id_user', 2)->value('id');
        $juanTutorId = DB::table('tutores')->where('id_user', 3)->value('id');

        $lauraAlumnoId = DB::table('alumnos')->where('id_user', 7)->value('id');
        $davidAlumnoId = DB::table('alumnos')->where('id_user', 8)->value('id');
        $saraAlumnoId = DB::table('alumnos')->where('id_user', 9)->value('id');
        $miguelAlumnoId = DB::table('alumnos')->where('id_user', 10)->value('id');

        $rows = [
            ['id_alumno' => $lauraAlumnoId, 'id_tutor' => $mariaTutorId],
            ['id_alumno' => $davidAlumnoId, 'id_tutor' => $mariaTutorId],
            ['id_alumno' => $saraAlumnoId, 'id_tutor' => $juanTutorId],
            ['id_alumno' => $miguelAlumnoId, 'id_tutor' => $juanTutorId],
        ];

        $rows = array_values(array_filter($rows, fn ($row) => $row['id_alumno'] && $row['id_tutor']));

        foreach ($rows as $row) {
            DB::table('alumnos_tutores')->insert($row);
        }
    }
}


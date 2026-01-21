<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TutoresCiclosSeeder extends Seeder
{
    public function run(): void
    {
        $mariaTutorId = DB::table('tutores')->where('id_user', 2)->value('id');
        $juanTutorId = DB::table('tutores')->where('id_user', 3)->value('id');

        $damId = DB::table('ciclos')->where('codigo', 'DAM')->value('id');
        $dawId = DB::table('ciclos')->where('codigo', 'DAW')->value('id');
        $asirId = DB::table('ciclos')->where('codigo', 'ASIR')->value('id');

        $rows = [
            ['id_tutor' => $mariaTutorId, 'id_ciclo' => $damId],
            ['id_tutor' => $mariaTutorId, 'id_ciclo' => $dawId],
            ['id_tutor' => $juanTutorId, 'id_ciclo' => $damId],
            ['id_tutor' => $juanTutorId, 'id_ciclo' => $asirId],
        ];

        $rows = array_values(array_filter($rows, fn ($row) => $row['id_tutor'] && $row['id_ciclo']));

        foreach ($rows as $row) {
            DB::table('tutores_ciclos')->insert([
                ...$row,
                'created_at' => now(),
            ]);
        }
    }
}

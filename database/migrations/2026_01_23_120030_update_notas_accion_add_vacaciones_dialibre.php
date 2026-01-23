<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('notas_seguimiento')) {
            DB::statement("ALTER TABLE notas_seguimiento MODIFY accion ENUM('PRESENTACION_ALUMNO','LLAMADA_SEGUIMIENTO','VISITA_CENTRO_TRABAJO','REUNION_PROFESORES','REUNION_TUTOR_PRACTICAS','INCIDENCIA','EVALUACION','OTRA','VACACIONES','DIA_LIBRE') NOT NULL DEFAULT 'EVALUACION'");
        }
    }

    public function down(): void
    {
        if (Schema::hasTable('notas_seguimiento')) {
            DB::statement("ALTER TABLE notas_seguimiento MODIFY accion ENUM('PRESENTACION_ALUMNO','LLAMADA_SEGUIMIENTO','VISITA_CENTRO_TRABAJO','REUNION_PROFESORES','REUNION_TUTOR_PRACTICAS','INCIDENCIA','EVALUACION','OTRA') NOT NULL DEFAULT 'EVALUACION'");
        }
    }
};

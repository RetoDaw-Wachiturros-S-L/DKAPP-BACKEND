<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (!Schema::hasTable('notas_seguimiento')) {
            Schema::create('notas_seguimiento', function (Blueprint $table) {
                $table->id();
                $table->foreignId('id_estancia')->constrained('estancias_formativas')->cascadeOnDelete();
                $table->foreignId('id_alumno')->constrained('alumnos')->cascadeOnDelete();
                $table->date('fecha');
                $table->enum('accion', ['PRESENTACION_ALUMNO', 'LLAMADA_SEGUIMIENTO', 'VISITA_CENTRO_TRABAJO', 'REUNION_PROFESORES', 'REUNION_TUTOR_PRACTICAS', 'INCIDENCIA', 'EVALUACION', 'OTRA'])->default('OTRA');
                $table->text('contenido')->comment('Contenido de la nota o seguimiento');
                $table->timestamps();

                $table->index('id_estancia');
                $table->index('id_alumno');
                $table->index('fecha');
                $table->index('accion');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notas_seguimiento');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('estancias_formativas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_alumno')->constrained('alumnos')->onDelete('restrict');
            $table->foreignId('id_empresa')->constrained('empresas')->onDelete('restrict');
            $table->foreignId('id_tutor_empresa')->constrained('users')->onDelete('restrict');
            $table->foreignId('id_tutor_centro')->constrained('users')->onDelete('restrict');
            $table->foreignId('id_curso')->constrained('cursos')->onDelete('restrict');
            $table->date('fecha_inicio')->nullable();
            $table->date('fecha_fin')->nullable();
            $table->integer('horas_totales')->nullable();
            $table->integer('horas_realizadas')->default(0);
            $table->enum('estado', ['PLANIFICADA', 'EN_CURSO', 'COMPLETADA', 'CANCELADA'])->default('PLANIFICADA');
            $table->text('observaciones')->nullable();
            $table->timestamps();

            $table->index('id_alumno');
            $table->index('id_empresa');
            $table->index('id_curso');
            $table->index('estado');
            $table->index(['fecha_inicio','fecha_fin']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('estancias_formativas');
    }
};

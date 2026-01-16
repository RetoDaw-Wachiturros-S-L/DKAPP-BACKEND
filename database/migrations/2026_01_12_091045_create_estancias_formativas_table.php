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
        if (!Schema::hasTable('estancias_formativas')) {
            Schema::create('estancias_formativas', function (Blueprint $table) {
                $table->id();
                $table->foreignId('id_alumno')->constrained('alumnos')->restrictOnDelete();
                $table->foreignId('id_empresa')->constrained('empresas')->restrictOnDelete();
                $table->foreignId('id_tutor_empresa')->constrained('users')->restrictOnDelete()->comment('Usuario con rol TUTOR_EMPRESA');
                $table->foreignId('id_tutor_centro')->constrained('users')->restrictOnDelete()->comment('Usuario con rol TUTOR_CENTRO');
                $table->foreignId('id_curso')->constrained('cursos')->restrictOnDelete()->comment('Curso en el que se realiza la estancia');
                $table->date('fecha_inicio');
                $table->date('fecha_fin');
                $table->integer('horas_totales')->comment('Horas totales de la estancia');
                $table->integer('horas_realizadas')->default(0)->comment('Horas completadas hasta el momento');
                $table->enum('estado', ['PLANIFICADA', 'EN_CURSO', 'COMPLETADA', 'CANCELADA'])->default('PLANIFICADA');
                $table->text('observaciones')->nullable();
                $table->timestamps();

                $table->index('id_alumno');
                $table->index('id_empresa');
                $table->index('id_curso');
                $table->index('estado');
                $table->index(['fecha_inicio', 'fecha_fin']);
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('estancias_formativas');
    }
};

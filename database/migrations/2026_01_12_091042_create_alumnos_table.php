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
        if (!Schema::hasTable('alumnos')) {
            Schema::create('alumnos', function (Blueprint $table) {
                $table->id();
                $table->foreignId('id_user')->unique()->constrained('users')->cascadeOnDelete();
                $table->string('dni', 15)->unique()->nullable()->comment('DNI del alumno');
                $table->string('numero_cuaderno', 50)->nullable()->comment('Número de cuaderno/expediente');
                $table->foreignId('id_ciclo')->constrained('ciclos')->restrictOnDelete()->comment('Ciclo en el que está matriculado');
                $table->integer('curso_actual')->nullable()->comment('Curso actual: 1, 2, 3...');
                $table->string('poblacion')->nullable();
                $table->timestamps();

                $table->index('dni');
                $table->index('id_ciclo');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alumnos');
    }
};

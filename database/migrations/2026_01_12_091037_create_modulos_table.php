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
        Schema::create('modulos', function (Blueprint $table) {
            $table->id();
            $table->string('codigo', 50)->unique()->comment('Código del módulo');
            $table->string('nombre')->comment('Nombre del módulo');
            $table->foreignId('id_curso')->constrained('cursos')->restrictOnDelete()->comment('Curso al que pertenece');
            $table->integer('horas_totales')->nullable()->comment('Total de horas del módulo');
            $table->timestamps();
            
            $table->index('codigo');
            $table->index('id_curso');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('modulos');
    }
};

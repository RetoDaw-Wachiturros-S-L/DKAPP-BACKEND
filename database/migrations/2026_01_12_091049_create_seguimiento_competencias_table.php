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
        Schema::create('seguimiento_competencias', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_estancia')->constrained('estancias_formativas')->cascadeOnDelete();
            $table->foreignId('id_competencia')->constrained('competencias')->restrictOnDelete();
            $table->integer('numero_semana')->comment('Número de semana en la que se trabaja');
            $table->date('fecha_inicio');
            $table->date('fecha_fin');
            $table->timestamps();
            
            $table->unique(['id_estancia', 'id_competencia', 'numero_semana'], 'uk_estancia_comp_semana');
            $table->index('id_estancia');
            $table->index('id_competencia');
            $table->index('numero_semana');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('seguimiento_competencias');
    }
};

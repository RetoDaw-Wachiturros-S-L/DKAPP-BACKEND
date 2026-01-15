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
        Schema::create('evaluaciones', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_estancia')->constrained('estancias_formativas')->cascadeOnDelete();
            $table->foreignId('id_modulo')->constrained('modulos')->restrictOnDelete()->comment('Módulo que se está evaluando');
            $table->decimal('nota_previa', 4, 2)->nullable()->comment('Nota previa a FCT (80% de la nota final) - dato en duro');
            $table->decimal('nota_competencias_tecnicas', 4, 2)->nullable()->comment('Evaluación de competencias técnicas por tutor empresa (0-10)');
            $table->decimal('nota_competencias_transversales', 4, 2)->nullable()->comment('Evaluación de competencias transversales por tutor empresa (0-10)');
            $table->decimal('nota_cuaderno', 4, 2)->nullable()->comment('Evaluación del cuaderno por tutor centro (0-10)');
            $table->decimal('nota_fct_calculada', 4, 2)->nullable()->comment('Nota FCT calculada (20% de la nota final)');
            $table->decimal('nota_final', 4, 2)->nullable()->comment('Nota final calculada (80% previa + 20% FCT)');
            $table->text('observaciones')->nullable();
            $table->date('fecha_evaluacion');
            $table->timestamps();
            
            $table->unique(['id_estancia', 'id_modulo']);
            $table->index('id_estancia');
            $table->index('id_modulo');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('evaluaciones');
    }
};

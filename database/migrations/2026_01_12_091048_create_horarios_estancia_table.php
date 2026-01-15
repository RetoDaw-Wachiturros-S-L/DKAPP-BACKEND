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
        Schema::create('horarios_estancia', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_estancia')->constrained('estancias_formativas')->cascadeOnDelete();
            $table->enum('dia_semana', ['LUNES', 'MARTES', 'MIERCOLES', 'JUEVES', 'VIERNES', 'SABADO', 'DOMINGO']);
            $table->enum('turno', ['MAÑANA', 'TARDE', 'NOCHE', 'CONTINUO'])->default('CONTINUO');
            $table->time('hora_inicio');
            $table->time('hora_fin');
            $table->timestamps();
            
            $table->index('id_estancia');
            $table->index('dia_semana');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('horarios_estancia');
    }
};

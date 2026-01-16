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
        if (!Schema::hasTable('cursos')) {
            Schema::create('cursos', function (Blueprint $table) {
                $table->id();
                $table->foreignId('id_ciclo')->constrained('ciclos')->restrictOnDelete()->comment('Ciclo al que pertenece');
                $table->integer('numero_curso')->comment('Número del curso: 1, 2, 3...');
                $table->string('nombre')->comment('Ej: 1º DAM, 2º DAM');
                $table->timestamps();

                $table->unique(['id_ciclo', 'numero_curso']);
                $table->index('id_ciclo');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cursos');
    }
};

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
        if (!Schema::hasTable('resultados_aprendizaje')) {
            Schema::create('resultados_aprendizaje', function (Blueprint $table) {
                $table->id();
                $table->string('codigo', 50)->unique()->comment('Código del RA');
                $table->text('descripcion')->comment('Descripción del resultado de aprendizaje');
                $table->foreignId('id_ciclo')->constrained('ciclos')->restrictOnDelete()->comment('Ciclo al que pertenece');
                $table->timestamps();

                $table->index('codigo');
                $table->index('id_ciclo');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resultados_aprendizaje');
    }
};

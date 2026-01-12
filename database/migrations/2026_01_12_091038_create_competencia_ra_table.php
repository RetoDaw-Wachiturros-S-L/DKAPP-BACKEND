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
        Schema::create('competencia_ra', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_competencia')->constrained('competencias')->cascadeOnDelete();
            $table->foreignId('id_ra')->constrained('resultados_aprendizaje')->cascadeOnDelete();
            $table->timestamp('created_at')->useCurrent();
            
            $table->unique(['id_competencia', 'id_ra']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('competencia_ra');
    }
};

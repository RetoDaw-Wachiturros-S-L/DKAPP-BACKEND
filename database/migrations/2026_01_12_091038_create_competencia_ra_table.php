<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('competencia_ra', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_competencia')->constrained('competencias')->onDelete('cascade');
            $table->foreignId('id_ra')->constrained('resultados_aprendizaje')->onDelete('cascade');
            $table->timestamps();

            $table->unique(['id_competencia', 'id_ra']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('competencia_ra');
    }
};

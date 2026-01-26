<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('cursos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_ciclo')->constrained('ciclos')->onDelete('restrict');
            $table->integer('numero_curso');
            $table->string('nombre');
            $table->timestamps();

            $table->unique(['id_ciclo', 'numero_curso']);
            $table->index('id_ciclo');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cursos');
    }
};

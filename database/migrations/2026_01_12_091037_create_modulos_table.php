<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('modulos', function (Blueprint $table) {
            $table->id();
            $table->string('codigo', 50)->unique();
            $table->string('nombre');
            $table->foreignId('id_curso')->constrained('cursos')->onDelete('restrict');
            $table->integer('horas_totales')->nullable();
            $table->timestamps();

            $table->index('codigo');
            $table->index('id_curso');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('modulos');
    }
};

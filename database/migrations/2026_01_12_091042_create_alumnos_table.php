<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('alumnos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_user')->unique()->constrained('users')->onDelete('cascade');
            $table->string('dni', 15)->unique()->nullable();
            $table->string('numero_cuaderno', 50)->nullable();
            $table->foreignId('id_ciclo')->constrained('ciclos')->onDelete('restrict');
            $table->integer('curso_actual')->nullable();
            $table->string('poblacion')->nullable();
            $table->timestamps();

            $table->index('dni');
            $table->index('id_ciclo');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('alumnos');
    }
};

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
        if (!Schema::hasTable('incidencias')) {
            Schema::create('incidencias', function (Blueprint $table) {
                $table->id();
                $table->foreignId('id_usuario')->constrained('users')->cascadeOnDelete();
                $table->enum('tipo', ['MEJORA', 'NO FUNCIONA', 'PROBLEMA', 'OTRO'])->default('OTRO');
                $table->text('descripcion');
                $table->enum('estado', ['ACTIVA', 'INACTIVA', 'CERRADA'])->default('ACTIVA');
                $table->timestamps();

                $table->index('id_usuario');
                $table->index('tipo');
                $table->index('estado');
                $table->index('created_at');
            });
        }

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('incidencias');
    }
};

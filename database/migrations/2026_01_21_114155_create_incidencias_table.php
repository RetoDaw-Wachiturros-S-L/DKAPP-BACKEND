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
                $table->dateTime('fecha_hora');
                $table->string('tipo_incidencia');
                $table->text('descripcion');
                $table->foreignId('id_usuario')->constrained('users')->cascadeOnDelete();
                $table->timestamps();

                $table->index('id_usuario');
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

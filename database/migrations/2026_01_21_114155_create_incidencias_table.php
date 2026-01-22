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
        // Evitar error si la tabla ya existe (p. ej. creada desde un SQL import)
        if (!Schema::hasTable('incidencias')) {
            Schema::create('incidencias', function (Blueprint $table) {
                $table->id(); // PK autoincremental
                // Campos mínimos: fecha/hora, tipo, descripción
                // Mantengo nombres compatibles con cambios previos
                $table->dateTime('fecha_hora');
                $table->string('tipo_incidencia');
                $table->text('descripcion');

                 // id_usuario: usuario que crea la incidencia (obligatorio)
                 $table->unsignedBigInteger('id_usuario');    // FK al usuario que rellena
                $table->timestamps();
                // Añadir constraint para emitente (si existe la tabla users)
                if (Schema::hasTable('users')) {
                    $table->foreign('id_usuario')->references('id')->on('users')->onDelete('cascade');
                }
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

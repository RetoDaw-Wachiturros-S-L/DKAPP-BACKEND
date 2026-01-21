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
        Schema::create('incidencias', function (Blueprint $table) {
            $table->id(); // PK autoincremental
            $table->dateTime('fecha_hora');
            $table->string('tipo_incidencia');
            $table->text('descripcion');
            $table->unsignedBigInteger('inscripcion_id'); // inscripción relacionada
            $table->unsignedBigInteger('emitente_id');    // FK al usuario que rellena
            $table->timestamps();

            $table->foreign('inscripcion_id')->references('id')->on('inscripciones')->onDelete('cascade');
            $table->foreign('emitente_id')->references('id')->on('users')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('incidencias');
    }
};

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
        Schema::create('empresas', function (Blueprint $table) {
            $table->id();
            $table->string('nombre')->comment('Nombre de la empresa');
            $table->string('cif', 20)->unique()->comment('CIF de la empresa');
            $table->string('direccion');
            $table->string('localidad')->nullable();
            $table->string('provincia')->nullable();
            $table->string('codigo_postal', 10)->nullable();
            $table->string('telefono', 20);
            $table->string('email');
            $table->enum('estado', ['ACTIVA', 'INACTIVA', 'SUSPENDIDA'])->default('ACTIVA');
            $table->timestamps();
            
            $table->index('nombre');
            $table->index('estado');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('empresas');
    }
};

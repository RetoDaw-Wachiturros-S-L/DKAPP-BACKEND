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
        if (!Schema::hasTable('ciclos')) {
            Schema::create('ciclos', function (Blueprint $table) {
                $table->id();
                $table->string('codigo', 50)->unique()->comment('Código del ciclo formativo');
                $table->string('nombre')->comment('Nombre del ciclo');
                $table->integer('nivel')->comment('Nivel del ciclo (Superior, Medio, etc)');
                $table->boolean('activo')->default(true);
                $table->timestamps();

                $table->index('codigo');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ciclos');
    }
};

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
        if (!Schema::hasTable('competencias')) {
            Schema::create('competencias', function (Blueprint $table) {
                $table->id();
                $table->string('codigo', 50)->unique()->comment('Código de la competencia');
                $table->text('descripcion')->comment('Descripción de la competencia');
                $table->enum('tipo', ['TECNICA', 'TRANSVERSAL', 'PERSONAL'])->default('TECNICA');
                $table->timestamps();

                $table->index('codigo');
                $table->index('tipo');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('competencias');
    }
};

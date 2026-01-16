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
        if (!Schema::hasTable('modulo_competencia')) {
            Schema::create('modulo_competencia', function (Blueprint $table) {
                $table->id();
                $table->foreignId('id_modulo')->constrained('modulos')->cascadeOnDelete();
                $table->foreignId('id_competencia')->constrained('competencias')->cascadeOnDelete();
                $table->timestamp('created_at')->useCurrent();

                $table->unique(['id_modulo', 'id_competencia']);
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('modulo_competencia');
    }
};

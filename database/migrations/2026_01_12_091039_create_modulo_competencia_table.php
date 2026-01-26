<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('modulo_competencia', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_modulo')->constrained('modulos')->onDelete('cascade');
            $table->foreignId('id_competencia')->constrained('competencias')->onDelete('cascade');
            $table->timestamp('created_at')->useCurrent();

            $table->unique(['id_modulo', 'id_competencia']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('modulo_competencia');
    }
};

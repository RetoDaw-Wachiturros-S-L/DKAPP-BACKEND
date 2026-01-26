<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('competencias', function (Blueprint $table) {
            $table->id();
            $table->string('codigo', 50)->unique();
            $table->text('descripcion');
            $table->enum('tipo', ['TECNICA', 'TRANSVERSAL', 'PERSONAL'])->default('TECNICA');
            $table->timestamps();

            $table->index('codigo');
            $table->index('tipo');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('competencias');
    }
};

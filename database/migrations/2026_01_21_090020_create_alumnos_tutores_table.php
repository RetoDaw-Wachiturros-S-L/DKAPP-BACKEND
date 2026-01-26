<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('alumnos_tutores', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_alumno')->nullable()->constrained('alumnos')->onDelete('set null');
            $table->foreignId('id_tutor')->nullable()->constrained('tutores')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('alumnos_tutores');
    }
};

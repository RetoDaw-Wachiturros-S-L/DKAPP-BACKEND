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
        if (! Schema::hasTable('alumnos_tutores')) {
            Schema::create('alumnos_tutores', function (Blueprint $table) {
                $table->id();
                $table->foreignId('id_alumno')->nullable()->constrained('alumnos')->nullOnDelete();
                $table->foreignId('id_tutor')->nullable()->constrained('tutores')->nullOnDelete();
                $table->timestamp('created_at')->useCurrent();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alumnos_tutores');
    }
};


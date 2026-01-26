<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('apellidos');
            $table->string('email')->unique();
            $table->string('telefono', 20)->nullable();
            $table->enum('rol', ['ADMIN', 'TUTOR_CENTRO', 'TUTOR_EMPRESA', 'ALUMNO']);
            $table->string('password');
            $table->boolean('activo')->default(true);
            $table->timestamp('email_verified_at')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->index('email');
            $table->index('rol');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};

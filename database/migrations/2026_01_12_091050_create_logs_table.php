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
        Schema::create('logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_usuario')->nullable()->constrained('users')->nullOnDelete()->comment('Usuario que generó el log (NULL para logs del sistema)');
            $table->enum('nivel', ['DEBUG', 'INFO', 'WARNING', 'ERROR', 'CRITICAL'])->default('INFO');
            $table->string('tipo', 100)->nullable()->comment('Tipo de evento: auth, database, api, email, file, etc.');
            $table->text('mensaje')->comment('Descripción del evento');
            $table->json('contexto')->nullable()->comment('Información adicional del evento');
            $table->string('tabla_afectada', 100)->nullable()->comment('Tabla de BD afectada (si aplica)');
            $table->integer('registro_id')->nullable()->comment('ID del registro afectado (si aplica)');
            $table->string('ip', 45)->nullable()->comment('Dirección IP del cliente');
            $table->text('user_agent')->nullable()->comment('User agent del navegador');
            $table->string('url', 500)->nullable()->comment('URL de la petición');
            $table->string('metodo_http', 10)->nullable()->comment('GET, POST, PUT, DELETE, etc.');
            $table->timestamp('created_at')->useCurrent();
            
            $table->index('id_usuario');
            $table->index('nivel');
            $table->index('tipo');
            $table->index('tabla_afectada');
            $table->index('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('logs');
    }
};

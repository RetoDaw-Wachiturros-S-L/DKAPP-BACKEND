<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('ciclos')) {
            Schema::create('ciclos', function (Blueprint $table) {
                $table->id();
<<<<<<< HEAD

                $table->string('codigo', 50)
                    ->unique()
                    ->comment('Código del ciclo formativo');

                $table->string('nombre')
                    ->comment('Nombre del ciclo');

                $table->integer('nivel')
                    ->comment('Nivel del ciclo (Superior, Medio, etc)');

                $table->enum('familia_profesional', [
                    'Informática',
                    'Sanidad',
                    'Administración',
                    'Electricidad',
                    'Mecánica',
                    'Hostelería',
                    'Imagen y Sonido'
                ])->comment('Familia profesional del ciclo');

=======
                $table->string('codigo', 50)->unique()->comment('Código del ciclo formativo');
                $table->string('nombre')->comment('Nombre del ciclo');
                $table->integer('nivel')->comment('Nivel del ciclo (Superior, Medio, etc)');
                $table->enum('familia', ['INFORMATICA', 'SANIDAD', 'ADMINISTRACION', 'ELECTRICIDAD', 'MECANICA', 'HOSTELERIA', 'IMAGEN_Y_SONIDO'])->comment('Familia profesional');
>>>>>>> e6498a92afbd6f5b34daaf60621a239ef5b2a2f7
                $table->boolean('activo')->default(true);

                $table->timestamps();

                $table->index('codigo');
                $table->index('familia');
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('ciclos');
    }
};


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
        if (! Schema::hasTable('tutores')) {
            Schema::create('tutores', function (Blueprint $table) {
                $table->id();
                $table->foreignId('id_user')->unique()->constrained('users')->cascadeOnDelete();
                $table->string('dni', 15)->unique()->nullable();
                $table->boolean('es_de_egibide')->default(true);
                $table->string('poblacion')->nullable();
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tutores');
    }
};

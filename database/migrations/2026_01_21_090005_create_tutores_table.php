<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('tutores', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_user')->unique()->constrained('users')->onDelete('cascade');
            $table->string('dni', 15)->unique()->nullable();
            $table->boolean('es_de_egibide')->default(true);
            $table->string('poblacion')->nullable();
            $table->timestamps();

            $table->foreignId('id_centro')->constrained('centros');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tutores');
    }
};

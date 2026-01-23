<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasColumn('ciclos', 'familia')) {
            Schema::table('ciclos', function (Blueprint $table) {
                $table->enum('familia', ['INFORMATICA', 'SANIDAD', 'ADMINISTRACION', 'ELECTRICIDAD', 'MECANICA', 'HOSTELERIA', 'IMAGEN_Y_SONIDO'])->after('nivel');
                $table->index('familia');
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('ciclos', 'familia')) {
            Schema::table('ciclos', function (Blueprint $table) {
                $table->dropIndex(['familia']);
                $table->dropColumn('familia');
            });
        }
    }
};

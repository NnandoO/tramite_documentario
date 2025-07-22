<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('expedientes', function (Blueprint $table) {
            $table->string('tipo_documento')->nullable()->after('sumilla');
            $table->string('area_procedencia')->nullable()->after('tipo_documento');
            $table->string('documento_path')->nullable()->after('observaciones');
        });
    }

    public function down(): void
    {
        Schema::table('expedientes', function (Blueprint $table) {
            $table->dropColumn(['tipo_documento', 'area_procedencia', 'documento_path']);
        });
    }
};

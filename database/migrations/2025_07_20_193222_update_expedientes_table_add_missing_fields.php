<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('expedientes', function (Blueprint $table) {
            if (Schema::hasColumn('expedientes', 'name')) {
                $table->renameColumn('name', 'solicitante');
            }
            if (!Schema::hasColumn('expedientes', 'fecha_archivo')) {
                $table->timestamp('fecha_archivo')->nullable()->after('fecha_envio');
            }
            if (!Schema::hasColumn('expedientes', 'observacion_archivo')) {
                $table->text('observacion_archivo')->nullable()->after('fecha_archivo');
            }
            if (!Schema::hasColumn('expedientes', 'archivo_cargo')) {
                $table->string('archivo_cargo')->nullable()->after('observacion_archivo');
            }
        });
    }

    public function down(): void
    {
        Schema::table('expedientes', function (Blueprint $table) {
            if (Schema::hasColumn('expedientes', 'solicitante')) {
                $table->renameColumn('solicitante', 'name');
            }
            if (Schema::hasColumn('expedientes', 'fecha_archivo')) {
                $table->dropColumn(['fecha_archivo', 'observacion_archivo', 'archivo_cargo']);
            }
        });
    }
};

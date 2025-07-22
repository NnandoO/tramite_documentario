<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('expedientes', function (Blueprint $table) {
            $table->string('medio_envio')->nullable();
            $table->timestamp('fecha_envio')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('expedientes', function (Blueprint $table) {
            $table->dropColumn(['medio_envio', 'fecha_envio']);
        });
    }
};

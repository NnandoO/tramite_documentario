<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('notificaciones_historial', function (Blueprint $table) {
            $table->id();
            $table->foreignId('notificacion_id')->constrained('notificacion_solicitudes');
            $table->foreignId('operador_id')->constrained('users');
            $table->string('accion');
            $table->timestamp('created_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('notificaciones_historial');
    }
};

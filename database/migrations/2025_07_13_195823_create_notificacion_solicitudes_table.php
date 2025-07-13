<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('notificacion_solicitudes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('expediente_entregado_id')->constrained('expediente_entregado');
            $table->foreignId('solicitud_id')->constrained('solicitud_expedientes');
            $table->foreignId('operador_id')->constrained('users');
            $table->timestamp('enviado_at');
            $table->enum('estado', ['enviada','realizada']);
            $table->timestamp('realizado_at')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('notificacion_solicitudes');
    }
};

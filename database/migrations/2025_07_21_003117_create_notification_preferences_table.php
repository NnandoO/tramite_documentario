<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('notification_preferences', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->unique()->constrained()->onDelete('cascade'); // Un registro por usuario
            $table->boolean('email_enabled')->default(true); // Recibir por email
            $table->boolean('database_enabled')->default(true); // Recibir en la app (el que ya haces)
            $table->boolean('push_enabled')->default(false); // Para futuras notificaciones push
            $table->time('start_time')->nullable(); // Horario de inicio para recibir (ej: 09:00)
            $table->time('end_time')->nullable(); // Horario de fin para recibir (ej: 17:00)
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('notification_preferences');
    }
};
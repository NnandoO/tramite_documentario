<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tramites', function (Blueprint $table) {
            $table->id();
            $table->string('expediente')->unique();
            $table->string('tipo_tramite');
            $table->enum('estado', ['Borrador', 'Enviado', 'En Proceso', 'Pendiente de Revisión', 'Aprobado', 'Rechazado', 'Archivado']);
            $table->datetime('fecha_envio');
            $table->string('funcionario')->nullable();
            $table->string('cargo_funcionario')->nullable();
            $table->json('historial')->nullable();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            // Campos para Cambio de Asesor
            $table->string('nuevo_asesor')->nullable();
            $table->text('justificacion')->nullable();

            // Campos para Designación de Jurado
            $table->string('titulo_proyecto')->nullable();
            $table->string('asesor_actual')->nullable();

            // Campos para Carta de No Adeudo
            $table->enum('tipo_no_adeudo', ['LABORATORIO', 'BIBLIOTECA'])->nullable();

            // Campo para documentos adjuntos
            $table->json('documentos')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tramites');
    }
};

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
        Schema::create('tramites', function (Blueprint $table) {
            $table->id();
            $table->string('documento');
            $table->string('codigo')->unique();
            $table->string('solicitante');
            $table->date('fecha_inicio');
            $table->string('estado')->default('Pendiente');
            $table->timestamps();
            $table->string('funcionario_destinatario')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tramites');
    }
};
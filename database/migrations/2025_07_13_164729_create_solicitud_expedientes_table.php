<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('solicitud_expedientes', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_solicitante');
            $table->string('codigo_expediente');
            $table->foreignId('tipo_tramite_id')->constrained('tramites');
            $table->foreignId('facultad_id')->constrained('facultades');
            $table->date('fecha');
            $table->text('observaciones')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('solicitud_expedientes');
    }
};

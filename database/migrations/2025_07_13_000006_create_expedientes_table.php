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
        Schema::create('expedientes', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->foreignId('dependencia_id')->constrained('dependencias');
            $table->foreignId('tipo_tramite_id')->constrained('tramites');
            $table->foreignId('facultad_id')->constrained('facultades');
            $table->date('fecha_expediente');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('expedientes');
    }
};

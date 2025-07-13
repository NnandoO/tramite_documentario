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
        Schema::create('expediente_entregado', function (Blueprint $table) {
            $table->id();
            $table->foreignId('expediente_id')->constrained('expedientes');
            $table->foreignId('solicitud_id')->constrained('solicitud_expedientes');
            $table->foreignId('user_id')->constrained('users');
            $table->string('ruta');
            $table->boolean('visible_para_usuario')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('expediente_entregado');
    }
};

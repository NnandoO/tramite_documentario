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
        Schema::create('audit_entregas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('expediente_id')->constrained('expedientes');
            $table->foreignId('solicitante_id')->constrained('users');
            $table->foreignId('operador_id')->constrained('users');
            $table->timestamp('delivered_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('audit_entregas');
    }
};

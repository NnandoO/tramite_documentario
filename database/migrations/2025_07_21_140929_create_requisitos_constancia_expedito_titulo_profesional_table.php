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
        Schema::create('requisitos_constancia_expedito_titulo_profesional', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tramite_type_id');
            $table->foreign('tramite_type_id', 'fk_requisitos_tramite_type')
                  ->references('id')
                  ->on('tramite_types')
                  ->onDelete('cascade');
            $table->string('titulo');
            $table->text('descripcion')->nullable();
            $table->string('duracion')->nullable();
            $table->string('area')->nullable();
            $table->string('dependencia')->nullable();
            $table->boolean('requiere_foto')->default(false);
            $table->json('requisitos');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('requisitos_constancia_expedito_titulo_profesional');
    }
};

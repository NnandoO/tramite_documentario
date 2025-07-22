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
            $table->string('codigo');
            $table->string('name');
            $table->string('dni', 8)->nullable();
            $table->year('year')->nullable()->index();
            $table->foreignId('month_id')->nullable()->constrained('months')->nullOnDelete()->cascadeOnUpdate();
            $table->date('fecha_ingreso');
            $table->foreignId('faculty_id')->nullable()->constrained('facultades')->nullOnDelete()->cascadeOnUpdate();
            $table->foreignId('tramite_type_id')->nullable()->constrained('tramite_types')->nullOnDelete()->cascadeOnUpdate();
            $table->foreignId('status_id')->nullable()->constrained('statuses')->nullOnDelete()->cascadeOnUpdate();
            $table->string('sumilla');
            $table->text('observaciones')->nullable();
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

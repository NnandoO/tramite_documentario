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
        $table->string('name');
        $table->year('year')->nullable();
        $table->string('month')->nullable();
        $table->unsignedBigInteger('faculty_id')->nullable(); // Si usarás relación
        $table->string('document_type')->nullable();
        $table->string('status')->nullable();
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

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('notificaciones', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')->constrained()->cascadeOnDelete(); // destinatario
            $table->unsignedBigInteger('expediente_id')->nullable()->index();
            $table->string('titulo')->nullable();
            $table->text('mensaje')->nullable();
            $table->boolean('visto')->default(false);

            // datetime con default current_timestamp()
            $table->dateTime('enviado_at')->default(DB::raw('CURRENT_TIMESTAMP'));

            // created_at y updated_at con default y auto update
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();

            // Foreign key
            $table->foreign('expediente_id')
                  ->references('id')
                  ->on('expedientes')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('notificaciones');
    }
};

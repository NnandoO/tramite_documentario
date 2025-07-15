<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Expediente>
 */
class ExpedienteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(){
        return [
            'usuario_id' => \App\Models\User::factory(),
            'codigo' => 'EXP-' . fake()->numberBetween(1000, 9999),
            'tipo_tramite' => 'Solicitud', // 👈🏽 AÑADE ESTO
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }

}

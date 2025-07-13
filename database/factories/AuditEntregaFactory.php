<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Expediente;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\AuditEntrega>
 */
class AuditEntregaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'expediente_id' => Expediente::factory(),
            'solicitante_id' => User::factory(),
            'operador_id' => User::factory(),
            'delivered_at' => now(),
        ];
    }
}

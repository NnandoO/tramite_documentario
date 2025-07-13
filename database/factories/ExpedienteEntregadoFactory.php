<?php

namespace Database\Factories;

use App\Models\Expediente;
use App\Models\ExpedienteEntregado;
use App\Models\SolicitudExpediente;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ExpedienteEntregadoFactory extends Factory
{
    protected $model = ExpedienteEntregado::class;

    public function definition(): array
    {
        return [
            'expediente_id' => Expediente::factory(),
            'solicitud_id' => SolicitudExpediente::factory(),
            'ruta' => 'entregas/'.$this->faker->word.'.pdf',
            'user_id' => User::factory(),
            'visible_para_usuario' => false,
        ];
    }
}

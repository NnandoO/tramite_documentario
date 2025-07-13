<?php

namespace Database\Factories;

use App\Models\SolicitudExpediente;
use App\Models\Tramite;
use App\Models\Facultad;
use Illuminate\Database\Eloquent\Factories\Factory;

class SolicitudExpedienteFactory extends Factory
{
    protected $model = SolicitudExpediente::class;

    public function definition(): array
    {
        return [
            'nombre_solicitante' => $this->faker->name(),
            'codigo_expediente' => strtoupper($this->faker->bothify('EXP###')),
            'tipo_tramite_id' => Tramite::factory(),
            'facultad_id' => Facultad::factory(),
            'fecha' => $this->faker->date(),
            'motivo' => $this->faker->optional()->sentence(),
            'status' => SolicitudExpediente::PENDING,
            'observaciones' => $this->faker->optional()->sentence(),
        ];
    }
}

<?php

namespace Database\Factories;

use App\Models\Expediente;
use App\Models\Dependencia;
use App\Models\Tramite;
use App\Models\Facultad;
use Illuminate\Database\Eloquent\Factories\Factory;

class ExpedienteFactory extends Factory
{
    protected $model = Expediente::class;

    public function definition(): array
    {
        return [
            'codigo' => strtoupper($this->faker->bothify('EXP###')),
            'nombre' => $this->faker->sentence(2),
            'dependencia_id' => Dependencia::factory(),
            'tipo_tramite_id' => Tramite::factory(),
            'facultad_id' => Facultad::factory(),
            'fecha_expediente' => $this->faker->date(),
            'restringido' => $this->faker->boolean(20),
        ];
    }
}

<?php

namespace Database\Factories;

use App\Models\TramiteType;
use App\Models\Expedientes;
use App\Models\Facultad;
use App\Models\Month;
use App\Models\Status;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<\App\Models\Expedientes>
 */
class ExpedientesFactory extends Factory
{
    protected $model = Expedientes::class;

    public function definition(): array
    {
        return [
            'codigo' => strtoupper(Str::random(8)),
            'name' => $this->faker->name(),
            'dni' => $this->faker->numerify('########'),
            'year' => $this->faker->numberBetween(2021, 2025),
            'month_id' => Month::inRandomOrder()->value('id'),
            'faculty_id' => Facultad::inRandomOrder()->value('id'),
            'tramite_type_id' => TramiteType::inRandomOrder()->value('id'),
            'status_id' => Status::inRandomOrder()->value('id'),
            'sumilla' => $this->faker->sentence(),
            'observaciones' => $this->faker->optional()->sentence(),
        ];
    }
}

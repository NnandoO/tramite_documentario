<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\NotificacionHistorial;
use App\Models\NotificacionSolicitud;
use App\Models\User;

class NotificacionHistorialFactory extends Factory
{
    protected $model = NotificacionHistorial::class;

    public function definition(): array
    {
        return [
            'notificacion_id' => NotificacionSolicitud::factory(),
            'operador_id' => User::factory(),
            'accion' => 'enviada',
            'created_at' => now(),
        ];
    }
}

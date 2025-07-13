<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\NotificacionSolicitud;
use App\Models\ExpedienteEntregado;
use App\Models\SolicitudExpediente;
use App\Models\User;

class NotificacionSolicitudFactory extends Factory
{
    protected $model = NotificacionSolicitud::class;

    public function definition(): array
    {
        return [
            'expediente_entregado_id' => ExpedienteEntregado::factory(),
            'solicitud_id' => SolicitudExpediente::factory(),
            'operador_id' => User::factory(),
            'enviado_at' => now(),
            'estado' => 'enviada',
            'realizado_at' => null,
        ];
    }
}

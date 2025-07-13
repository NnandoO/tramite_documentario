<?php

namespace Tests\Feature;

use App\Models\ExpedienteEntregado;
use App\Models\NotificacionSolicitud;
use App\Models\SolicitudExpediente;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class NotificacionSolicitudTest extends TestCase
{
    use RefreshDatabase;

    public function test_store_creates_record_and_updates_solicitud(): void
    {
        $operator = User::factory()->create(['role_id' => 4]);
        $entrega = ExpedienteEntregado::factory()->create();
        $solicitud = $entrega->solicitud;

        $response = $this->actingAs($operator)->post(route('operador.notificacion.store', $entrega), [
            'expediente_entregado_id' => $entrega->id,
            'solicitud_id' => $solicitud->id,
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('notificacion_solicitudes', [
            'expediente_entregado_id' => $entrega->id,
            'solicitud_id' => $solicitud->id,
            'operador_id' => $operator->id,
            'estado' => 'enviada',
        ]);
        $this->assertEquals('Aprobada – Enviada para notificación', $solicitud->refresh()->status);
    }

    public function test_only_operator_can_store(): void
    {
        $operator = User::factory()->create(['role_id' => 4]);
        $user = User::factory()->create();
        $entrega = ExpedienteEntregado::factory()->create();

        $this->actingAs($operator)->post(route('operador.notificacion.store', $entrega), [
            'expediente_entregado_id' => $entrega->id,
            'solicitud_id' => $entrega->solicitud_id,
        ])->assertRedirect();

        $this->actingAs($user)->post(route('operador.notificacion.store', $entrega), [
            'expediente_entregado_id' => $entrega->id,
            'solicitud_id' => $entrega->solicitud_id,
        ])->assertStatus(403);
    }
}



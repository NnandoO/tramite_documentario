<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Tramite;
use App\Models\Facultad;
use App\Models\Expediente;
use App\Models\SolicitudExpediente;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SolicitudExpedienteTest extends TestCase
{
    use RefreshDatabase;

    public function test_validation_errors_on_empty_fields(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post(route('expedientes.solicitar.store'), []);

        $response->assertSessionHasErrors(['nombre_solicitante','codigo_expediente','tipo_tramite','facultad','fecha']);
    }

    public function test_store_solicitud_successfully(): void
    {
        $user = User::factory()->create();
        $tramite = Tramite::factory()->create();
        $facultad = Facultad::factory()->create();
        Expediente::factory()->create(['codigo' => 'EXP123']);

        $data = [
            'nombre_solicitante' => 'Juan',
            'codigo_expediente' => 'EXP123',
            'tipo_tramite' => $tramite->id,
            'facultad' => $facultad->id,
            'fecha' => now()->format('Y-m-d'),
            'observaciones' => 'Test',
        ];

        $response = $this->actingAs($user)->post(route('expedientes.solicitar.store'), $data);

        $response->assertRedirect();
        $this->assertDatabaseHas('solicitud_expedientes', [
            'nombre_solicitante' => 'Juan',
            'codigo_expediente' => 'EXP123',
        ]);
    }

    public function test_motivo_required_when_expediente_restricted(): void
    {
        $user = User::factory()->create();
        $tramite = Tramite::factory()->create();
        $facultad = Facultad::factory()->create();
        Expediente::factory()->create(['codigo' => 'EXPRES', 'restringido' => true]);

        $data = [
            'nombre_solicitante' => 'Ana',
            'codigo_expediente' => 'EXPRES',
            'tipo_tramite' => $tramite->id,
            'facultad' => $facultad->id,
            'fecha' => now()->format('Y-m-d'),
        ];

        $response = $this->actingAs($user)->post(route('expedientes.solicitar.store'), $data);

        $response->assertSessionHasErrors('motivo');
    }

    public function test_motivo_optional_when_expediente_not_restricted(): void
    {
        $user = User::factory()->create();
        $tramite = Tramite::factory()->create();
        $facultad = Facultad::factory()->create();
        Expediente::factory()->create(['codigo' => 'EXPFREE', 'restringido' => false]);

        $data = [
            'nombre_solicitante' => 'Ana',
            'codigo_expediente' => 'EXPFREE',
            'tipo_tramite' => $tramite->id,
            'facultad' => $facultad->id,
            'fecha' => now()->format('Y-m-d'),
        ];

        $response = $this->actingAs($user)->post(route('expedientes.solicitar.store'), $data);

        $response->assertSessionDoesntHaveErrors();
        $this->assertDatabaseHas('solicitud_expedientes', ['codigo_expediente' => 'EXPFREE']);
    }

    public function test_solicitud_creates_with_pending_status_and_notifies_operator(): void
    {
        \Notification::fake();

        $user = User::factory()->create();
        $operator = User::factory()->create(['role_id' => 4]);
        $tramite = Tramite::factory()->create();
        $facultad = Facultad::factory()->create();
        Expediente::factory()->create(['codigo' => 'EXP555']);

        $data = [
            'nombre_solicitante' => 'Luis',
            'codigo_expediente' => 'EXP555',
            'tipo_tramite' => $tramite->id,
            'facultad' => $facultad->id,
            'fecha' => now()->format('Y-m-d'),
            'observaciones' => 'Prueba',
        ];

        $this->actingAs($user)->post(route('expedientes.solicitar.store'), $data);

        $this->assertDatabaseHas('solicitud_expedientes', [
            'codigo_expediente' => 'EXP555',
            'status' => SolicitudExpediente::PENDING,
        ]);

        \Notification::assertSentTo($operator, \App\Notifications\NuevaSolicitudExpedienteNotification::class);
    }
}

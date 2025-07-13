<?php

namespace Tests\Feature;

use App\Models\SolicitudExpediente;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class OperadorSolicitudesTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_shows_pending_solicitudes(): void
    {
        $operator = User::factory()->create(['role_id' => 4]);
        SolicitudExpediente::factory()->count(2)->create();

        $response = $this->actingAs($operator)->get(route('operador.solicitudes.index'));

        $response->assertStatus(200);
        $response->assertSee('Solicitudes Pendientes');
    }
}

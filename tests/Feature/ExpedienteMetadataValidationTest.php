<?php

namespace Tests\Feature;

use App\Models\Dependencia;
use App\Models\Facultad;
use App\Models\Tramite;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExpedienteMetadataValidationTest extends TestCase
{
    use RefreshDatabase;

    public function test_metadata_fields_are_required(): void
    {
        $user = User::factory()->create();
        $dependencia = Dependencia::factory()->create();

        $response = $this->actingAs($user)->post('/expedientes', [
            'nombre' => 'Expediente',
            'dependencia' => $dependencia->id,
        ]);

        $response->assertSessionHasErrors(['tipo_tramite', 'fecha_expediente', 'facultad']);
    }

    public function test_expediente_is_stored_when_metadata_valid(): void
    {
        $user = User::factory()->create();
        $dependencia = Dependencia::factory()->create();
        $tramite = Tramite::factory()->create();
        $facultad = Facultad::factory()->create();

        $response = $this->actingAs($user)->post('/expedientes', [
            'nombre' => 'Expediente',
            'dependencia' => $dependencia->id,
            'tipo_tramite' => $tramite->id,
            'fecha_expediente' => now()->format('Y-m-d'),
            'facultad' => $facultad->id,
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('expedientes', [
            'nombre' => 'Expediente',
            'tipo_tramite_id' => $tramite->id,
        ]);
    }
}

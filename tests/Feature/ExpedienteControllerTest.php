<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Expediente;
use App\Models\Requisito;
use App\Models\ExpedienteRequisito;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ExpedienteControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_pantalla_verificacion_carga_correctamente()
    {
        // Crear usuario y expediente
        $user = User::factory()->create();
        $expediente = Expediente::factory()->create(['usuario_id' => $user->id]);

        // Crear requisito
        $requisito = Requisito::factory()->create();
        ExpedienteRequisito::create([
            'expediente_id' => $expediente->id,
            'requisito_id' => $requisito->id,
            'estado' => 'Cumple',
        ]);

        // Llamar a la ruta
        $response = $this->get("/operador/expediente/verificar/{$expediente->id}");

        $response->assertStatus(200);
        $response->assertSee('VERIFICACIÓN DE EXPEDIENTE');
        $response->assertSee($requisito->nombre);
    }
}

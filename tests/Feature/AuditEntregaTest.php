<?php

namespace Tests\Feature;

use App\Models\AuditEntrega;
use App\Models\Expediente;
use App\Models\SolicitudExpediente;
use App\Models\User;
use App\Models\Role;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class AuditEntregaTest extends TestCase
{
    use RefreshDatabase;

    public function test_store_creates_audit_record(): void
    {
        Storage::fake('local');

        $operator = User::factory()->create(['role_id' => 4]);
        $solicitud = SolicitudExpediente::factory()->create();
        $expediente = Expediente::factory()->create(['codigo' => $solicitud->codigo_expediente]);

        $response = $this->actingAs($operator)->post(route('operador.solicitudes.entregar.store', $solicitud->id), [
            'files' => [UploadedFile::fake()->create('file.pdf', 100, 'application/pdf')],
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('audit_entregas', [
            'expediente_id' => $expediente->id,
            'operador_id' => $operator->id,
        ]);
    }

    public function test_only_product_owner_can_view_audit_page(): void
    {
        $role = Role::create(['name' => 'product_owner']);
        $owner = User::factory()->create(['role_id' => $role->id]);
        $user = User::factory()->create();

        $this->actingAs($owner)->get(route('auditoria.entregas.index'))
            ->assertStatus(200);

        $this->actingAs($user)->get(route('auditoria.entregas.index'))
            ->assertStatus(403);
    }
}

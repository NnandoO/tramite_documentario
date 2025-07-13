<?php

namespace Tests\Feature;

use App\Models\Expediente;
use App\Models\SolicitudExpediente;
use App\Models\User;
use App\Models\ExpedienteEntregado;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ExpedienteEntregadoTest extends TestCase
{
    use RefreshDatabase;

    public function test_store_creates_entregas(): void
    {
        Storage::fake('local');

        $operator = User::factory()->create(['role_id' => 4]);
        $solicitud = SolicitudExpediente::factory()->create();
        $expediente = Expediente::factory()->create(['codigo' => $solicitud->codigo_expediente]);

        $files = [
            UploadedFile::fake()->create('a.pdf', 100, 'application/pdf'),
            UploadedFile::fake()->create('b.docx', 100, 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'),
        ];

        $response = $this->actingAs($operator)->post(route('operador.solicitudes.entregar.store', $solicitud->id), [
            'files' => $files,
        ]);

        $response->assertRedirect();
        $this->assertDatabaseCount('expediente_entregado', 2);
        Storage::disk('local')->assertExists('entregas/'.$files[0]->hashName());
        $this->assertEquals(SolicitudExpediente::APPROVED, $solicitud->refresh()->status);
    }

    public function test_notify_marks_visible_and_sends_notification(): void
    {
        Notification::fake();
        $operator = User::factory()->create(['role_id' => 4]);
        $user = User::factory()->create();
        $entrega = ExpedienteEntregado::factory()->create(['user_id' => $user->id]);

        $this->actingAs($operator)->post(route('operador.entregados.notificar', $entrega));

        $this->assertTrue($entrega->refresh()->visible_para_usuario);
        Notification::assertSentTo($user, \App\Notifications\ExpedienteEntregadoNotification::class);
    }
}

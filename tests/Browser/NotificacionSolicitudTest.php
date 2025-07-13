<?php

namespace Tests\Browser;

use App\Models\ExpedienteEntregado;
use App\Models\User;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class NotificacionSolicitudTest extends DuskTestCase
{
    use DatabaseMigrations;

    public function test_operator_generates_notification(): void
    {
        $operator = User::factory()->create(['role_id' => 4]);
        $entrega = ExpedienteEntregado::factory()->create();

        $this->browse(function (Browser $browser) use ($operator, $entrega) {
            $browser->loginAs($operator)
                ->visit(route('operador.entregas.show', $entrega))
                ->press('Generar solicitud de notificación')
                ->pause(500)
                ->assertSee('Historial');
        });
    }

    public function test_unidad_confirma_notificacion(): void
    {
        $operator = User::factory()->create(['role_id' => 4]);
        $unidad = User::factory()->create(['role_id' => 5]);
        $entrega = ExpedienteEntregado::factory()->create();

        $noti = $operator->notificacionSolicitudes()->create([
            'expediente_entregado_id' => $entrega->id,
            'solicitud_id' => $entrega->solicitud_id,
            'enviado_at' => now(),
            'estado' => 'enviada',
        ]);

        $this->browse(function (Browser $browser) use ($unidad, $noti) {
            $browser->loginAs($unidad)
                ->visit('/')
                ->visit(route('notificaciones.confirmar', $noti))
                ->pause(500)
                ->assertPathIs('/');
        });
    }
}


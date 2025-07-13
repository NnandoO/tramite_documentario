<?php

namespace Tests\Browser;

use App\Models\SolicitudExpediente;
use App\Models\User;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class OperadorSolicitudesTest extends DuskTestCase
{
    use DatabaseMigrations;

    public function test_dashboard_shows_pending_solicitud(): void
    {
        $operator = User::factory()->create(['role_id' => 4]);
        SolicitudExpediente::factory()->create();

        $this->browse(function (Browser $browser) use ($operator) {
            $browser->loginAs($operator)
                ->visit('/operador/solicitudes')
                ->assertSee('Solicitudes Pendientes');
        });
    }
}

<?php

namespace Tests\Browser;

use App\Models\User;
use App\Models\Tramite;
use App\Models\Facultad;
use App\Models\Expediente;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class SolicitudExpedienteTest extends DuskTestCase
{
    use DatabaseMigrations;

    public function test_form_flow(): void
    {
        $user = User::factory()->create();
        $tramite = Tramite::factory()->create();
        $facultad = Facultad::factory()->create();
        Expediente::factory()->create(['codigo' => 'EXP999']);

        $this->browse(function (Browser $browser) use ($user, $tramite, $facultad) {
            $browser->loginAs($user)
                ->visit('/expedientes/solicitar')
                ->press('Enviar solicitud')
                ->pause(500)
                ->assertSee('El campo nombre solicitante')
                ->type('nombre_solicitante', 'Juan')
                ->type('codigo_expediente', 'EXP999')
                ->select('tipo_tramite', $tramite->id)
                ->select('facultad', $facultad->id)
                ->type('fecha', now()->format('Y-m-d'))
                ->press('Enviar solicitud')
                ->pause(500)
                ->assertPathIs('/expedientes/solicitar');
        });
    }

    public function test_restricted_expediente_requires_motivo(): void
    {
        $user = User::factory()->create();
        $tramite = Tramite::factory()->create();
        $facultad = Facultad::factory()->create();
        Expediente::factory()->create(['codigo' => 'EXPRES', 'restringido' => true]);

        $this->browse(function (Browser $browser) use ($user, $tramite, $facultad) {
            $browser->loginAs($user)
                ->visit('/expedientes/solicitar?codigo_expediente=EXPRES')
                ->assertSee('expediente es restringido')
                ->type('nombre_solicitante', 'Ana')
                ->type('codigo_expediente', 'EXPRES')
                ->select('tipo_tramite', $tramite->id)
                ->select('facultad', $facultad->id)
                ->type('fecha', now()->format('Y-m-d'))
                ->press('Enviar solicitud')
                ->pause(500)
                ->assertSee('El campo motivo')
                ->type('motivo', 'Investigación')
                ->press('Enviar solicitud')
                ->pause(500)
                ->assertPathIs('/expedientes/solicitar');
        });
    }
}

<?php

namespace Tests\Browser;

use App\Models\User;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class OperatorDashboardTest extends DuskTestCase
{
    use DatabaseMigrations;

    public function test_operator_sees_dashboard_links(): void
    {
        $operator = User::factory()->create(['role_id' => 4]);

        $this->browse(function (Browser $browser) use ($operator) {
            $browser->loginAs($operator)
                ->visit('/operador/repositorio')
                ->assertSee('Repositorio Digital')
                ->clickLink('Solicitudes')
                ->assertPathIs('/operador/solicitudes');
        });
    }

    public function test_user_cannot_access_operator_routes(): void
    {
        $user = User::factory()->create(['role_id' => 1]);

        $this->browse(function (Browser $browser) use ($user) {
            $browser->loginAs($user)
                ->visit('/operador/repositorio')
                ->assertSee('Acceso no permitido');
        });
    }
}

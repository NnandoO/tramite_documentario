<?php

namespace Tests\Browser;

use App\Models\AuditEntrega;
use App\Models\Role;
use App\Models\User;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class AuditEntregaViewTest extends DuskTestCase
{
    use DatabaseMigrations;

    public function test_audit_page_loads_without_edit_buttons(): void
    {
        $role = Role::create(['name' => 'product_owner']);
        $owner = User::factory()->create(['role_id' => $role->id]);

        AuditEntrega::factory()->create();

        $this->browse(function (Browser $browser) use ($owner) {
            $browser->loginAs($owner)
                ->visit(route('auditoria.entregas.index'))
                ->assertDontSee('Editar')
                ->assertDontSee('Eliminar');
        });
    }
}

<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class OperatorDashboardAccessTest extends TestCase
{
    use RefreshDatabase;

    public function test_guests_are_redirected_to_login(): void
    {
        $this->get('/operador/repositorio')->assertRedirect('/login');
    }

    public function test_user_without_operator_role_is_denied(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/operador/repositorio');

        $response->assertStatus(403);
        $response->assertSee('Acceso no permitido');
    }

    public function test_session_expires_after_inactivity(): void
    {
        $operator = User::factory()->create(['role_id' => 4]);

        $this->actingAs($operator)->get('/operador/repositorio');

        $this->travel(11)->minutes();

        $this->get('/operador/repositorio')->assertRedirect('/login');

        $this->travelBack();
    }
}

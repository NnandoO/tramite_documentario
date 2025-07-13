<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Role;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuditEntregaAccessTest extends TestCase
{
    use RefreshDatabase;

    public function test_product_owner_can_access(): void
    {
        Role::create(['id' => 5, 'name' => 'product_owner']);
        $owner = User::factory()->create(['role_id' => 5]);

        $this->actingAs($owner)
            ->get('/operador/auditoria')
            ->assertStatus(200);
    }

    public function test_operator_cannot_access(): void
    {
        $operator = User::factory()->create(['role_id' => 4]);

        $this->actingAs($operator)
            ->get('/operador/auditoria')
            ->assertStatus(403);
    }
}

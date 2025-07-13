<?php

namespace Tests\Feature;

use App\Livewire\ArchivoCentral;
use App\Models\Expediente;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class ArchivoCentralTest extends TestCase
{
    use RefreshDatabase;

    public function test_dynamic_searching(): void
    {
        Expediente::factory()->create(['codigo' => 'EXP001']);
        Expediente::factory()->create(['codigo' => 'EXP002']);

        Livewire::test(ArchivoCentral::class)
            ->set('search', 'EXP001')
            ->assertSee('EXP001')
            ->assertDontSee('EXP002');
    }

    public function test_reset_filters_button(): void
    {
        $component = Livewire::test(ArchivoCentral::class)
            ->set('search', 'hola')
            ->set('year', 2025)
            ->call('resetFilters');

        $component->assertSet('search', '')
            ->assertSet('year', null);
    }

    public function test_show_no_results_message(): void
    {
        Livewire::test(ArchivoCentral::class)
            ->set('search', 'nada')
            ->assertSee('SIN RESULTADOS');
    }
}

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
        Expediente::factory()->create(['nombre' => 'Alpha']);
        Expediente::factory()->create(['nombre' => 'Beta']);

        Livewire::test(ArchivoCentral::class)
            ->set('search', 'Alpha')
            ->assertSee('Alpha')
            ->assertDontSee('Beta');
    }

    public function test_reset_filters_button(): void
    {
        $component = Livewire::test(ArchivoCentral::class)
            ->set('search', 'hola')
            ->set('year', 2025)
            ->call('resetFilters');

        $component->assertSet('search', null)
            ->assertSet('year', null);
    }

    public function test_show_no_results_message(): void
    {
        Livewire::test(ArchivoCentral::class)
            ->set('search', 'nada')
            ->assertSee('SIN RESULTADOS');
    }

    public function test_filters_refresh_results(): void
    {
        Expediente::factory()->create(['fecha_expediente' => '2024-05-01']);
        Expediente::factory()->create(['fecha_expediente' => '2023-06-01']);

        Livewire::test(ArchivoCentral::class)
            ->set('year', 2024)
            ->assertSee('2024')
            ->set('year', 2023)
            ->assertSee('2023');
    }

    public function test_codigo_column_shows_id(): void
    {
        $expediente = Expediente::factory()->create();

        $component = Livewire::test(ArchivoCentral::class);
        $first = $component->viewData('expedientes')->first();

        $this->assertEquals($expediente->id, $first->codigo);
    }
}

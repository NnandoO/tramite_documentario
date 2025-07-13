<?php

namespace Tests\Feature;

use App\Livewire\ExpedientesFilter;
use App\Models\Expediente;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class ExpedientesFilterTest extends TestCase
{
    use RefreshDatabase;

    public function test_dynamic_filtering(): void
    {
        Expediente::factory()->create(['fecha_expediente' => '2024-05-01']);
        Expediente::factory()->create(['fecha_expediente' => '2023-06-01']);

        Livewire::test(ExpedientesFilter::class)
            ->set('year', 2024)
            ->assertSee('2024')
            ->set('year', 2023)
            ->assertSee('2023');
    }

    public function test_clear_filters_button(): void
    {
        $component = Livewire::test(ExpedientesFilter::class)
            ->set('year', 2024)
            ->call('resetFilters');

        $component->assertSet('year', null);
    }

    public function test_show_no_results_message(): void
    {
        Livewire::test(ExpedientesFilter::class)
            ->set('year', 1999)
            ->assertSee('SIN RESULTADOS');
    }
}

<?php

namespace Tests\Feature;

use App\Livewire\ArchivoCentral;
use App\Models\Expediente;
use App\Models\Facultad;
use App\Models\Tramite;
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

    public function test_filter_by_faculty(): void
    {
        $arquitectura = Facultad::factory()->create(['nombre' => 'Arquitectura']);
        $otra = Facultad::factory()->create(['nombre' => 'Ingeniería Civil']);

        Expediente::factory()->create(['facultad_id' => $arquitectura->id]);
        Expediente::factory()->create(['facultad_id' => $otra->id]);

        $component = Livewire::test(ArchivoCentral::class)
            ->set('faculty', 'Arquitectura');

        $data = $component->viewData('expedientes');

        $this->assertCount(1, $data);
        $this->assertEquals('Arquitectura', $data->first()->facultad->nombre);
    }

    public function test_filter_by_type(): void
    {
        $tipoA = Tramite::factory()->create(['nombre' => 'CARNÉ UNIVERSITARIO']);
        $tipoB = Tramite::factory()->create(['nombre' => 'SEMIBECAS Y BECAS – CEPRE']);

        Expediente::factory()->create(['tipo_tramite_id' => $tipoA->id]);
        Expediente::factory()->create(['tipo_tramite_id' => $tipoB->id]);

        $component = Livewire::test(ArchivoCentral::class)
            ->set('type', 'CARNÉ UNIVERSITARIO');

        $data = $component->viewData('expedientes');

        $this->assertCount(1, $data);
        $this->assertEquals('CARNÉ UNIVERSITARIO', $data->first()->tramite->nombre);
    }
}

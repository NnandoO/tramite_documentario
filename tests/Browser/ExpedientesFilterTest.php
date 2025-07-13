<?php

namespace Tests\Browser;

use App\Models\Expediente;
use App\Models\User;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ExpedientesFilterTest extends DuskTestCase
{
    use DatabaseMigrations;

    public function test_filters_and_reset_button(): void
    {
        Expediente::factory()->create(['fecha_expediente' => '2024-05-01']);

        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::factory()->create())
                ->visit('/expedientes')
                ->select('@year-filter', '2024')
                ->pause(500)
                ->assertSee('2024')
                ->press('@clear-filters')
                ->pause(500)
                ->assertInputValue('@year-filter', '');
        });
    }

    public function test_no_results_message_display(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::factory()->create())
                ->visit('/expedientes')
                ->select('@year-filter', '1999')
                ->pause(500)
                ->assertSee('SIN RESULTADOS');
        });
    }
}

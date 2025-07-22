<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class DatabaseStructureTest extends TestCase
{
    use RefreshDatabase;

    public function test_expedientes_table_has_expected_columns(): void
    {
        $this->assertTrue(Schema::hasColumns('expedientes', [
            'solicitante',
            'fecha_archivo',
            'observacion_archivo',
            'archivo_cargo'
        ]));
    }
}

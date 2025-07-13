<?php

namespace App\Livewire;

use App\Models\Expediente;
use App\Models\Facultad;
use App\Models\Tramite;
use Livewire\Component;
use Illuminate\Support\Facades\DB;

class ExpedientesFilter extends Component
{
    public $year;
    public $month;
    public $faculty;
    public $type;
    public $state;

    public function updated($property)
    {
        // Livewire will automatically re-render when a property changes.
    }

    public function resetFilters(): void
    {
        $this->reset(['year', 'month', 'faculty', 'type', 'state']);
    }

    public function getYearsProperty()
    {
        $driver = DB::connection()->getDriverName();
        $expression = $driver === 'sqlite'
            ? "strftime('%Y', fecha_expediente)"
            : 'YEAR(fecha_expediente)';

        return Expediente::query()
            ->selectRaw($expression.' as year')
            ->distinct()
            ->orderByDesc('year')
            ->pluck('year');
    }

    public function getMonthsProperty(): array
    {
        return [
            1 => __('Enero'),
            2 => __('Febrero'),
            3 => __('Marzo'),
            4 => __('Abril'),
            5 => __('Mayo'),
            6 => __('Junio'),
            7 => __('Julio'),
            8 => __('Agosto'),
            9 => __('Septiembre'),
            10 => __('Octubre'),
            11 => __('Noviembre'),
            12 => __('Diciembre'),
        ];
    }

    public function getFacultiesProperty()
    {
        return Facultad::orderBy('nombre')->pluck('nombre', 'id');
    }

    public function getTypesProperty()
    {
        return Tramite::orderBy('nombre')->pluck('nombre', 'id');
    }

    public function getStatesProperty(): array
    {
        return [
            'con_documentos' => __('Con Documentos'),
            'sin_documentos' => __('Sin Documentos'),
        ];
    }

    public function render()
    {
        $query = Expediente::with(['tramite', 'facultad']);

        $query->when($this->year, fn ($q) => $q->whereYear('fecha_expediente', $this->year));
        $query->when($this->month, fn ($q) => $q->whereMonth('fecha_expediente', $this->month));
        $query->when($this->faculty, fn ($q) => $q->where('facultad_id', $this->faculty));
        $query->when($this->type, fn ($q) => $q->where('tipo_tramite_id', $this->type));
        $query->when($this->state === 'con_documentos', fn ($q) => $q->has('documentos'));
        $query->when($this->state === 'sin_documentos', fn ($q) => $q->doesntHave('documentos'));

        $expedientes = $query->orderByDesc('fecha_expediente')->get();

        return view('livewire.expedientes-filter', [
            'expedientes' => $expedientes,
        ]);
    }
}

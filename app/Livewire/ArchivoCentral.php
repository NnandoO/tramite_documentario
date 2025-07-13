<?php

namespace App\Livewire;

use App\Models\Expediente;
use App\Models\Facultad;
use App\Models\Tramite;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class ArchivoCentral extends Component
{
    public $search = '';

    public $year;

    public $month;

    public $faculty;

    public $type;

    public $state;

    public function updated($field)
    {
        // component will re-render automatically
    }

    public function resetFilters()
    {
        $this->reset(['search', 'year', 'month', 'faculty', 'type', 'state']);
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
            'finalizado' => __('Finalizado'),
            'pendiente' => __('Pendiente'),
        ];
    }

    public function render()
    {
        $query = Expediente::with(['tramite', 'facultad']);

        $query->when($this->search, function ($q) {
            $search = $this->search;
            $q->where(function ($qq) use ($search) {
                $qq->where('nombre', 'like', "%{$search}%")
                    ->orWhere('codigo', 'like', "%{$search}%");
            });
        });
        $query->when($this->year, fn ($q) => $q->whereYear('fecha_expediente', $this->year));
        $query->when($this->month, fn ($q) => $q->whereMonth('fecha_expediente', $this->month));
        $query->when($this->faculty, fn ($q) => $q->where('facultad_id', $this->faculty));
        $query->when($this->type, fn ($q) => $q->where('tipo_tramite_id', $this->type));

        if ($this->state === 'finalizado') {
            $query->has('documentos');
        } elseif ($this->state === 'pendiente') {
            $query->doesntHave('documentos');
        }

        $expedientes = $query->orderByDesc('fecha_expediente')->get();

        return view('livewire.archivo-central', [
            'expedientes' => $expedientes,
        ]);
    }
}

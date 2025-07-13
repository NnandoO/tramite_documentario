<?php

namespace App\Livewire;

use App\Models\Expediente;
use App\Models\Facultad;
use App\Models\Tramite;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class ArchivoCentral extends Component
{
    use WithPagination;
    public $search = '';
    public $year;
    public $month;
    public $faculty;
    public $type;
    public $state;

    protected $queryString = [
        'search'  => ['except' => ''],
        'year'    => ['except' => null],
        'month'   => ['except' => null],
        'faculty' => ['except' => null],
        'type'    => ['except' => null],
        'state'   => ['except' => null],
    ];

    public function updated($field)
    {
        $this->resetPage();
    }

    public function resetFilters()
    {
        $this->search = null;
        $this->year = null;
        $this->month = null;
        $this->faculty = null;
        $this->type = null;
        $this->state = null;
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
        $query = Expediente::query()
            ->select(['id', 'id as codigo', 'nombre', 'fecha_expediente', 'facultad_id', 'tipo_tramite_id'])
            ->with(['tramite', 'facultad', 'documentos']);

        $query->when($this->search, function ($q) {
            $search = $this->search;
            $q->where('nombre', 'like', "%{$search}%");
        });
        $query->when($this->year, fn ($q) => $q->whereYear('fecha_expediente', $this->year));
        $query->when($this->month, fn ($q) => $q->whereMonth('fecha_expediente', $this->month));
        $query->when($this->faculty, fn ($q) => $q->where('facultad_id', $this->faculty));
        $query->when($this->type, fn ($q) => $q->where('tipo_tramite_id', $this->type));

        $query->when($this->state === 'finalizado', fn ($q) => $q->has('documentos'));
        $query->when($this->state === 'pendiente', fn ($q) => $q->doesntHave('documentos'));

        $expedientes = $query->orderByDesc('fecha_expediente')->get();

        return view('livewire.archivo-central', [
            'expedientes' => $expedientes,
        ]);
    }
}

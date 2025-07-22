<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;

class PanelSeguimiento extends Component
{
    public $resumen = [];
    public $expedientes = [];

    public $fechaInicio;
    public $fechaFin;

    public function mount()
    {
        $this->cargarDatos();
    }

    public function cargarDatos()
    {
        // Conteo general sin filtro (para mantener el resumen completo)
        $this->resumen = DB::table('expedientes')
            ->join('statuses', 'expedientes.status_id', '=', 'statuses.id')
            ->select('statuses.name as estado', DB::raw('count(*) as total'))
            ->groupBy('statuses.name')
            ->pluck('total', 'estado')
            ->toArray();

        // Filtro por fechas (si están definidos)
        $query = DB::table('expedientes')
            ->leftJoin('statuses', 'expedientes.status_id', '=', 'statuses.id')
            ->select('expedientes.*', 'statuses.name as estado')
            ->orderByDesc('expedientes.updated_at');

        if ($this->fechaInicio) {
            $query->whereDate('updated_at', '>=', $this->fechaInicio);
        }
        if ($this->fechaFin) {
            $query->whereDate('updated_at', '<=', $this->fechaFin);
        }

        $this->expedientes = $query->limit(20)->get();
    }

    public function render()
    {
        return view('livewire.panel-seguimiento');
    }
}

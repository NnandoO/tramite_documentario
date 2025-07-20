<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Expedientes;
use App\Models\Facultad;

class CentralFileFilter extends Component
{
    public $dni;
    public $year;
    public $month_id;
    public $faculty_id;
    public $tramite_type_id;
    public $status_id;
    public $facultades;
    public $months;
    public $tramiteTypes;
    public $statuses;
    public $years;

    public function mount()
    {
        $this->facultades = Facultad::orderBy('nombre')->get();
        $this->months = \App\Models\Month::all();
        $this->tramiteTypes = \App\Models\TramiteType::all();
        $this->statuses = \App\Models\Status::all();
        $this->years = Expedientes::select('year')->distinct()->orderBy('year')->pluck('year');
    }

    public function limpiarFiltros()
    {
        $this->reset(['dni', 'year', 'month_id', 'faculty_id', 'tramite_type_id', 'status_id']);
    }

    public function applyFilters()
    {
        // Method intentionally left blank; Livewire will re-render on invocation
    }

    public function render()
    {
        // Carga la relación facultad
        $query = Expedientes::with('facultad');

        if ($this->dni) {
            $query->where('dni', $this->dni);
        }

        if ($this->year) {
            $query->where('year', $this->year);
        }

        if ($this->month_id) {
            $query->where('month_id', $this->month_id);
        }

        if ($this->faculty_id) {
            $query->where('faculty_id', $this->faculty_id);
        }

        if ($this->tramite_type_id) {
            $query->where('tramite_type_id', $this->tramite_type_id);
        }

        if ($this->status_id) {
            $query->where('status_id', $this->status_id);
        }

        $files = $query->get();

        return view('livewire.central-file-filter', [
            'files' => $files,
            'facultades' => $this->facultades,
            'months' => $this->months,
            'tramiteTypes' => $this->tramiteTypes,
            'statuses' => $this->statuses,
            'years' => $this->years,
        ]);
    }
}

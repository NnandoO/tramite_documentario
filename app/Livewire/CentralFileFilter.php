<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Expedientes;
use App\Models\Facultad;

class CentralFileFilter extends Component
{
    public $search;
    public $year;
    public $month;
    public $faculty_id;
    public $document_type;
    public $status;
    public $facultades;

    public function mount()
    {
        $this->facultades = Facultad::orderBy('nombre')->get();
    }

    public function limpiarFiltros()
    {
        $this->reset(['search', 'year', 'month', 'faculty_id', 'document_type', 'status']);
    }

    public function applyFilters()
    {
        // Method intentionally left blank; Livewire will re-render on invocation
    }

    public function render()
    {
        // Carga la relación facultad
        $query = Expedientes::with('facultad');

        if ($this->search) {
            $query->where('name', 'like', "%{$this->search}%");
        }

        if ($this->year) {
            $query->where('year', $this->year);
        }

        if ($this->month) {
            $query->where('month', $this->month);
        }

        if ($this->faculty_id) {
            $query->where('faculty_id', $this->faculty_id);
        }

        if ($this->document_type) {
            $query->where('document_type', $this->document_type);
        }

        if ($this->status) {
            $query->where('status', $this->status);
        }

        $files = $query->get();

        return view('livewire.central-file-filter', compact('files'));
    }
}

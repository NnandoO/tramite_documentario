<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Tramite;
use App\Models\Status;
use Illuminate\Support\Facades\Auth;

class BandejaSalida extends Component
{
    public $tramites = [];
    public $tramiteSeleccionado = null;
    public $filtroEstado = null;
    public $filtroFuncionario = '';
    public $filtroFechaDesde = null;
    public $filtroFechaHasta = null;
    public $soloMisAcciones = false;
    public $statuses = [];

    public function mount()
    {
        $this->statuses = Status::orderBy('name')->pluck('name');
        $this->cargarTramites();
    }

    public function updated($property)
    {
        $this->cargarTramites();
    }

    public function cargarTramites()
    {
        $usuario = Auth::user();

        // Mostrar solo trámites donde el funcionario logueado es destinatario
        $query = Tramite::where('funcionario_destinatario', $usuario->email);

        // Opcional: filtrar además por solicitante si se activa el checkbox
        if ($this->soloMisAcciones) {
            $query->where('solicitante', $usuario->email);
        }

        if ($this->filtroEstado) {
            $query->where('estado', $this->filtroEstado);
        }

        if ($this->filtroFuncionario) {
            $query->where('funcionario_destinatario', 'like', '%' . $this->filtroFuncionario . '%');
        }

        if ($this->filtroFechaDesde) {
            $query->whereDate('fecha_inicio', '>=', $this->filtroFechaDesde);
        }

        if ($this->filtroFechaHasta) {
            $query->whereDate('fecha_inicio', '<=', $this->filtroFechaHasta);
        }

        $this->tramites = $query->orderByDesc('updated_at')->get();
    }

    public function seleccionarTramite($id)
    {
        $this->tramiteSeleccionado = Tramite::find($id);
    }

    public function render()
    {
        return view('livewire.bandeja-salida', [
            'statuses' => $this->statuses,
        ]);
    }
}

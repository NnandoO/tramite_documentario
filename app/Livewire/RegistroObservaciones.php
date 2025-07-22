<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Expediente;
use App\Models\Status;

class RegistroObservaciones extends Component
{
    public $expedienteId;
    public $expedienteCodigo = '';
    public $solicitante = '';
    public $estadoExpediente = 'Pendiente';
    public $resultado;
    public $observaciones = '';

    public function mount($expedienteId = null)
    {
        if ($expedienteId) {
            $expediente = Expediente::find($expedienteId);

            if ($expediente) {
                $this->expedienteId = $expediente->id;
                $this->expedienteCodigo = $expediente->codigo;
                $this->solicitante = $expediente->solicitante;
                $this->estadoExpediente = optional($expediente->status)->name;
            }
        }
    }

    public function guardarObservacion()
    {
        $this->validate([
            'resultado' => 'required',
            'observaciones' => 'required|min:5',
        ]);

        if ($this->expedienteId) {
            $expediente = Expediente::find($this->expedienteId);

            if ($expediente) {
                $statusName = $this->resultado === 'conforme' ? 'Aprobado' : 'Rechazado';
                $expediente->status_id = Status::where('name', $statusName)->value('id');
                $expediente->observaciones = $this->observaciones;

                // ✅ Registrar fecha de validación si es conforme (Aprobado)
                if ($this->resultado === 'conforme') {
                    $expediente->fecha_validacion = now();
                }

                $expediente->save();

                return redirect()->route('verificacionExpediente');
            }
        }
    }

    public function render()
    {
        return view('livewire.registro-observaciones');
    }
}

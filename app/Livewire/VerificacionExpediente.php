<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Expediente;
use App\Models\Status;

class VerificacionExpediente extends Component
{
    public $expedientes;
    public $expedienteSeleccionado = null;

    public function mount()
    {
        $this->expedientes = Expediente::with('status')->get();
    }

    public function seleccionarExpediente($id)
    {
        $this->expedienteSeleccionado = Expediente::find($id);
    }

    public function validarExpediente()
    {
        if ($this->expedienteSeleccionado) {
            $aprobado = Status::where('name', 'Aprobado')->value('id');
            $this->expedienteSeleccionado->status_id = $aprobado;
            $this->expedienteSeleccionado->fecha_validacion = now();
            $this->expedienteSeleccionado->save();

            $this->reset('expedienteSeleccionado');
            $this->expedientes = Expediente::with('status')->get();
        }
    }
    public function rechazarExpediente(){
        if ($this->expedienteSeleccionado) {
            $rechazado = Status::where('name', 'Rechazado')->value('id');
            $this->expedienteSeleccionado->status_id = $rechazado;
            $this->expedienteSeleccionado->save();

            $this->reset('expedienteSeleccionado');
            $this->expedientes = Expediente::with('status')->get();
        }
    }

    public function render()
    {
        return view('livewire.verificacion-expediente');
    }
}

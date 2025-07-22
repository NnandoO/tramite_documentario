<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class FormularioFlujo extends Component
{
    use WithFileUploads;

    public $codigo, $solicitante, $asunto, $tipo_documento;
    public $area_procedencia, $fecha_recepcion, $documento;
    public $observaciones;

    public function updated($property)
    {
        $this->validateOnly($property, [
            'codigo' => 'required|string|max:20',
            'solicitante' => 'required|string|max:100',
            'asunto' => 'required|string|max:150',
            'tipo_documento' => 'required|string|max:50',
            'area_procedencia' => 'required|string|max:100',
            'fecha_recepcion' => 'required|date',
            'documento' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'observaciones' => 'nullable|string|max:500',
        ]);
    }

    public function archivar(){
        $this->validate([
            'codigo' => 'required|string|max:20',
            'solicitante' => 'required|string|max:100',
            'asunto' => 'required|string|max:150',
            'tipo_documento' => 'required|string|max:50',
            'area_procedencia' => 'required|string|max:100',
            'fecha_recepcion' => 'required|date',
            'documento' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'observaciones' => 'required|string|max:500',
        ]);

        $documentoPath = null;

        if ($this->documento) {
            $documentoPath = $this->documento->store('documentos_flujo', 'public');
        }

        DB::table('expedientes')->insert([
            'codigo' => $this->codigo,
            'solicitante' => $this->solicitante,
            'sumilla' => $this->asunto,
            'tipo_documento' => $this->tipo_documento,
            'area_procedencia' => $this->area_procedencia,
            'fecha_ingreso' => $this->fecha_recepcion,
            'status_id' => 'Progreso',
            'observaciones' => $this->observaciones,
            'documento_path' => $documentoPath,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        session()->flash('success', 'El flujo ha sido archivado correctamente.');

        return redirect()->route('formularioFlujo');
    }


    public function limpiarCampos(){
        return redirect(request()->header('Referer'));
    }


    public function cancelar()
    {
        return redirect()->route('verificacionExpediente');
    }

    public function render()
    {
        return view('livewire.formulario-flujo');
    }
}

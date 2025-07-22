<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\TramiteType;
use App\Models\DetalleTramite;

class FormTramite extends Component
{
    use WithFileUploads;

    public $tramiteId;
    public $tramiteName;
    public $requisitos = [];
    public $detalles;
    public $sustento;
    public $archivos = [];

    public function mount($tramite)
    {
        $this->tramiteId = $tramite;

        $type = TramiteType::find($tramite);
        $this->tramiteName = $type?->name;

        $this->detalles = DetalleTramite::find($tramite);

        $modelo = "\\App\\Models\\Requisito{$tramite}";
        if (class_exists($modelo)) {
            $this->requisitos = $modelo::orderBy('id')->pluck('descripcion')->toArray();
        }
    }

    public function rules()
    {
        $rules = [
            'sustento' => 'required|string|max:255',
        ];
        foreach ($this->requisitos as $index => $req) {
            $rules["archivos.$index"] = 'required|file|max:5120';
        }
        return $rules;
    }

    public function enviarSolicitud()
    {
        $this->validate();
        foreach ($this->archivos as $archivo) {
            $archivo->store('tramites');
        }
        session()->flash('message', 'Solicitud enviada correctamente.');
        $this->reset(['sustento','archivos']);
    }

    public function volver()
    {
        return redirect()->route('tramites.lista');
    }

    public function render()
    {
        return view('livewire.form-tramite');
    }
}

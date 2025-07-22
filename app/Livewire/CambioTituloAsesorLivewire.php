<?php
namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;

class CambioTituloAsesorLivewire extends Component
{
    use WithFileUploads;

    public $asunto;
    public $archivo1;
    public $archivo2;
    public $archivo3;

    // ✅ Nombres visibles para los archivos seleccionados
    public $archivo1_nombre = 'Seleccionar archivo';
    public $archivo2_nombre = 'Seleccionar archivo';
    public $archivo3_nombre = 'Seleccionar archivo';

    // ✅ Detecta cuando se actualiza un archivo
    public function updated($propertyName)
    {
        if ($propertyName === 'archivo1' && $this->archivo1) {
            $this->archivo1_nombre = $this->archivo1->getClientOriginalName();
        }

        if ($propertyName === 'archivo2' && $this->archivo2) {
            $this->archivo2_nombre = $this->archivo2->getClientOriginalName();
        }

        if ($propertyName === 'archivo3' && $this->archivo3) {
            $this->archivo3_nombre = $this->archivo3->getClientOriginalName();
        }
    }

    public function enviarFormulario()
    {
        $this->validate([
            'asunto' => 'required|string',
            'archivo1' => 'required|file|max:5120',
            'archivo2' => 'nullable|file|max:5120',
            'archivo3' => 'nullable|file|max:5120',
        ]);

        $ruta1 = $this->archivo1->store('tramites', 'public');
        $ruta2 = $this->archivo2 ? $this->archivo2->store('tramites', 'public') : null;
        $ruta3 = $this->archivo3 ? $this->archivo3->store('tramites', 'public') : null;

        // Aquí debe integrarse con la base de datos del sistema
        // Ejemplo:
        // Tramite::create([
        //     'asunto' => $this->asunto,
        //     'archivo1' => $ruta1,
        //     'archivo2' => $ruta2,
        //     'archivo3' => $ruta3,
        //     'tipo' => 'otros',
        //     'usuario_id' => auth()->id(), // si hay login
        // ]);

        session()->flash('mensaje', 'Solicitud enviada correctamente');
        $this->reset(['asunto', 'archivo1', 'archivo2', 'archivo3', 'archivo1_nombre', 'archivo2_nombre', 'archivo3_nombre',]);
    }

    public function render()
    {
        return view('livewire.cambio_titulo_asesor_livewire');
    }
    public function resetForm()
    {
        $this->reset(['asunto', 'archivo1', 'archivo2', 'archivo3']);
        $this->archivo1_nombre = 'Seleccionar archivo';
        $this->archivo2_nombre = 'Seleccionar archivo';
        $this->archivo3_nombre = 'Seleccionar archivo';
    }
}
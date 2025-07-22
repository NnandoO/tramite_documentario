<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\ArchiveRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Carbon;

class BandejaEntrada extends Component
{
    public $requests = [];
    public $selectedRequest = null;
    public $ubicacion;
    public $comentario;

    public function mount()
    {
        $this->loadRequests();
    }

    public function loadRequests()
    {
        $this->requests = ArchiveRequest::with('expediente')
            ->whereNull('processed_at')
            ->orderByDesc('created_at')
            ->get();
    }

    public function selectRequest($id)
    {
        $this->selectedRequest = ArchiveRequest::with('expediente')->find($id);
        $this->ubicacion = null;
        $this->comentario = null;
    }

    public function generarReporte()
    {
        $this->validate([
            'ubicacion' => 'required|string|max:100',
            'comentario' => 'nullable|string|max:500',
        ]);

        if (!$this->selectedRequest) {
            return;
        }

        $exp = $this->selectedRequest->expediente;

        $nombre = 'reporte_' . $exp->id . '_' . Carbon::now()->timestamp . '.txt';
        $contenido = "Codigo: {$exp->codigo}\n" .
            "Solicitante: {$exp->solicitante}\n" .
            "Ubicacion: {$this->ubicacion}\n" .
            ($this->comentario ? "Comentario: {$this->comentario}\n" : '');
        Storage::disk('public')->put('reportes/' . $nombre, $contenido);

        $this->selectedRequest->processed_at = now();
        $this->selectedRequest->save();

        $this->selectedRequest = null;
        $this->loadRequests();
    }

    public function render()
    {
        return view('livewire.bandeja-entrada');
    }
    public function cancelar()
    {
        $this->selectedRequest = null;
        $this->ubicacion = null;
        $this->comentario = null;
        $this->dispatch('cancelarFormulario');
    }
}

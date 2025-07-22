<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use App\Models\Status;
use App\Models\ArchiveRequest;

class EntregarArchivar extends Component
{
    use WithFileUploads;

    public $expedientes = [];
    public $expedienteSeleccionado = null;

    public $fechaEntrega;
    public $archivoCargo; // archivo (pdf, imagen)
    public $observacionEntrega;

    public $mensajeExito = null;
    public $mensajeError = null;

    public function mount()
    {
        $this->cargarExpedientes();
    }

    public function cargarExpedientes()
    {
        $finalizado = Status::where('name', 'Finalizado')->value('id');
        $this->expedientes = DB::table('expedientes')
            ->leftJoin('statuses', 'expedientes.status_id', '=', 'statuses.id')
            ->select('expedientes.*', 'statuses.name as estado')
            ->where('expedientes.status_id', $finalizado)
            ->orderByDesc('expedientes.updated_at')
            ->get();
    }

    public function seleccionarExpediente($id)
    {
        $this->expedienteSeleccionado = DB::table('expedientes')
            ->leftJoin('statuses', 'expedientes.status_id', '=', 'statuses.id')
            ->select('expedientes.*', 'statuses.name as estado')
            ->where('expedientes.id', $id)
            ->first();
        $this->mensajeExito = null;
        $this->mensajeError = null;

        // Limpiar campos del formulario por si quedó algo anterior
        $this->fechaEntrega = null;
        $this->archivoCargo = null;
        $this->observacionEntrega = null;
    }

    public function archivarExpediente()
    {
        $this->validate([
            'fechaEntrega' => 'required|date',
            'archivoCargo' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'observacionEntrega' => 'nullable|string|max:500',
        ]);

        if (!$this->expedienteSeleccionado) {
            $this->mensajeError = 'Debe seleccionar un expediente.';
            return;
        }

        try {
            // Guardar archivo
            $archivoPath = $this->archivoCargo->store('cargos_archivo', 'public');

            // Actualizar expediente
            DB::table('expedientes')
                ->where('id', $this->expedienteSeleccionado->id)
                ->update([
                    'status_id' => Status::where('name', 'Archivado')->value('id'),
                    'fecha_archivo' => Carbon::parse($this->fechaEntrega),
                    'observacion_archivo' => $this->observacionEntrega,
                    'archivo_cargo' => $archivoPath,
                    'updated_at' => now(),
                ]);

            ArchiveRequest::create([
                'expediente_id' => $this->expedienteSeleccionado->id,
            ]);

            // Redireccionar para recargar
            return redirect()->route('entregarArchivar')->with('success', 'Expediente archivado correctamente.');

        } catch (\Exception $e) {
            $this->mensajeError = 'Ocurrió un error al archivar: ' . $e->getMessage();
            $this->mensajeExito = null;
        }
    }


    public function cancelarSeleccion()
    {
        $this->expedienteSeleccionado = null;
        $this->mensajeExito = null;
        $this->mensajeError = null;
    }

    public function render()
    {
        return view('livewire.entregar-archivar');
    }
}

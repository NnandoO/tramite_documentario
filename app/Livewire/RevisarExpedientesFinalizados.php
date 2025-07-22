<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use App\Models\Status;

class RevisarExpedientesFinalizados extends Component
{
    public $expedientes = [];
    public $expedienteSeleccionado = null;
    public $mensajeNotificacion = '';

    public function mount()
    {
        $this->cargarExpedientes();
    }

    public function cargarExpedientes()
    {
        $canalizado = Status::where('name', 'Canalizado')->value('id');
        $enviado = Status::where('name', 'Enviado')->value('id');
        $this->expedientes = DB::table('expedientes')
            ->leftJoin('statuses', 'expedientes.status_id', '=', 'statuses.id')
            ->select('expedientes.*', 'statuses.name as estado')
            ->where(function($query) use ($canalizado, $enviado) {
                $query->where('expedientes.status_id', $canalizado)
                      ->orWhere(function($q) use ($enviado) {
                          $q->where('expedientes.status_id', $enviado)
                            ->where('medio_envio', 'Sistema eDoc');
                      });
            })
            ->orderByDesc('fecha_envio')
            ->get();
    }

    public function seleccionarExpediente($id)
    {
        $this->expedienteSeleccionado = DB::table('expedientes')
            ->leftJoin('statuses', 'expedientes.status_id', '=', 'statuses.id')
            ->select('expedientes.*', 'statuses.name as estado')
            ->where('expedientes.id', $id)
            ->first();
        $this->mensajeNotificacion = '';
    }

    public function marcarComoFinalizado()
    {
        if ($this->expedienteSeleccionado) {
            // Actualiza estado del expediente
            $finalizado = Status::where('name', 'Finalizado')->value('id');
            DB::table('expedientes')
                ->where('id', $this->expedienteSeleccionado->id)
                ->update([
                    'status_id' => $finalizado,
                    'observaciones' => $this->mensajeNotificacion,
                    'updated_at' => now(),
                ]);

            // Agrega notificación para el solicitante
            DB::table('notificaciones')->insert([
                'expediente_id' => $this->expedienteSeleccionado->id,
                'mensaje' => $this->mensajeNotificacion ?? 'Su expediente ha sido finalizado',
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // Redirige recargando la vista con mensaje de éxito
            return redirect()->route('revisarExpedientesFinalizados')
                ->with('success', 'Expediente marcado como finalizado y notificación enviada.');
        }
    }



    public function cancelarSeleccion()
    {
        $this->expedienteSeleccionado = null;
        $this->mensajeNotificacion = '';
    }

    public function render()
    {
        return view('livewire.revisar-expedientes-finalizados');
    }
}

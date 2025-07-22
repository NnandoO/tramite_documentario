<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;

class NotificacionesSolicitante extends Component
{
    public $notificaciones = [];
    public $solicitante;

    public function mount()
    {
        // ⚙ En producción, cuando el otro equipo termine el login:
        $this->solicitante = auth()->user()->name;

        // 🔍 Paso 2: Cargar notificaciones asociadas a ese solicitante
        $this->notificaciones = DB::table('notificaciones')
            ->join('expedientes', 'notificaciones.expediente_id', '=', 'expedientes.id')
            ->where('expedientes.solicitante', $this->solicitante)
            ->orderByDesc('notificaciones.created_at')
            ->select(
                'notificaciones.mensaje',
                'notificaciones.created_at',
                'expedientes.codigo'
            )
            ->get();
    }

    public function render()
    {
        return view('livewire.notificaciones-solicitante');
    }
}

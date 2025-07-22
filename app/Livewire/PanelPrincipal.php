<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Tramite;
use App\Models\Notificacion;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class PanelPrincipal extends Component
{
    public $tramitesPendientes = [];
    public $tramiteSeleccionado = null;
    public $pendientes = 0;
    public $enProceso = 0;
    public $completados = 0;
    public $derivados = 0;

    public $fechaDesde = null;
    public $fechaHasta = null;

    public $observaciones = '';
    public $mostrarObservaciones = false;

    public function mount()
    {
        $this->cargarDatos();
    }

    public function cargarDatos()
    {
        $usuarioActual = Auth::user();
        
        $queryPendientes = Tramite::where('estado', 'Pendiente')
                                 ->where('funcionario_destinatario', $usuarioActual->email);

        if ($this->fechaDesde) {
            $queryPendientes->whereDate('fecha_inicio', '>=', $this->fechaDesde);
        }
        
        if ($this->fechaHasta) {
            $queryPendientes->whereDate('fecha_inicio', '<=', $this->fechaHasta);
        }

        $this->tramitesPendientes = $queryPendientes->orderBy('created_at', 'desc')->get();

        if ($this->tramitesPendientes->isNotEmpty() && !$this->tramiteSeleccionado) {
            $this->tramiteSeleccionado = $this->tramitesPendientes->first();
        }

        $this->pendientes = Tramite::where('estado', 'Pendiente')
                                ->where('funcionario_destinatario', $usuarioActual->email)
                                ->count();
        
        $this->enProceso = Tramite::whereIn('estado', ['En Revisión', 'Atendido'])
                                ->where('funcionario_destinatario', $usuarioActual->email)
                                ->count();
        
        $this->completados = Tramite::whereIn('estado', ['Aprobado', 'Finalizado'])
                                ->where('funcionario_destinatario', $usuarioActual->email)
                                ->count();
        
        $this->derivados = Tramite::where('estado', 'Derivado')
                                ->where('funcionario_destinatario', $usuarioActual->email)
                                ->count();
    }

    public function aplicarFiltros()
    {
        $this->cargarDatos();
        
        if ($this->tramiteSeleccionado && !$this->tramitesPendientes->contains('id', $this->tramiteSeleccionado->id)) {
            $this->tramiteSeleccionado = $this->tramitesPendientes->first();
        }
    }

    public function limpiarFiltros()
    {
        $this->fechaDesde = null;
        $this->fechaHasta = null;
        $this->cargarDatos();
    }

    public function updatedFechaDesde()
    {
        $this->aplicarFiltros();
    }

    public function updatedFechaHasta()
    {
        $this->aplicarFiltros();
    }

    public function seleccionarTramite($tramiteId)
    {
        $tramite = Tramite::where('id', $tramiteId)
                          ->where('funcionario_destinatario', Auth::user()->email)
                          ->first();
        
        if ($tramite) {
            $this->tramiteSeleccionado = $tramite;
        }
    }

    public function marcarAtendido($tramiteId)
    {
        $tramite = Tramite::where('id', $tramiteId)
            ->where('funcionario_destinatario', Auth::user()->email)
            ->first();

        if ($tramite) {
            $tramite->estado = 'Atendido';
            $tramite->save();

            Notificacion::create([
                'user_id' => Auth::id(),
                'titulo' => 'Trámite marcado como Atendido',
                'mensaje' => "Usted ha marcado como atendido el trámite #{$tramite->id} (tipo: {$tramite->documento}).",
                'visto' => false,
            ]);

            $solicitanteUser = User::where('email', $tramite->solicitante)->first();

            if ($solicitanteUser && $solicitanteUser->id !== Auth::id()) {
                Notificacion::create([
                    'user_id' => $solicitanteUser->id,
                    'titulo' => 'Actualización de trámite',
                    'mensaje' => "Tu trámite #{$tramite->id} ha sido marcado como 'Atendido' por " . Auth::user()->name . ".",
                    'visto' => false,
                ]);
            }

            if (method_exists($this, 'dispatch')) {
                $this->dispatch('notificacionCreada');
            } else {
                $this->emit('notificacionCreada');
            }

            $this->cargarDatos();

            if ($this->tramiteSeleccionado && $this->tramiteSeleccionado->id == $tramiteId) {
                $this->tramiteSeleccionado = $this->tramitesPendientes->first();
            }

            session()->flash('success', 'El trámite se ha marcado como "Atendido".');
        }
    }

    public function aprobar($tramiteId)
    {
        $tramite = Tramite::where('id', $tramiteId)
                          ->where('funcionario_destinatario', Auth::user()->email)
                          ->first();
        
        if ($tramite) {
            $tramite->estado = 'Aprobado';
            $tramite->save();

            $this->cargarDatos();
            
            if ($this->tramiteSeleccionado && $this->tramiteSeleccionado->id == $tramiteId) {
                $this->tramiteSeleccionado = $this->tramitesPendientes->first();
            }

            session()->flash('success', 'El trámite se ha aprobado correctamente.');
        }
    }

    public function finalizar($tramiteId)
    {
        $tramite = Tramite::where('id', $tramiteId)
                          ->where('funcionario_destinatario', Auth::user()->email)
                          ->first();
        
        if ($tramite) {
            $tramite->estado = 'Finalizado';
            $tramite->save();

            $this->cargarDatos();
            
            if ($this->tramiteSeleccionado && $this->tramiteSeleccionado->id == $tramiteId) {
                $this->tramiteSeleccionado = $this->tramitesPendientes->first();
            }

            session()->flash('success', 'El trámite se ha finalizado correctamente.');
        }
    }

    public function derivar($tramiteId)
    {
        // ✅ Redirección Livewire al formulario de derivación
        return $this->redirect(route('derivar.tramite', $tramiteId));
    }

    public function calcularDiasTranscurridos($fechaInicio)
    {
        $fechaInicio = Carbon::parse($fechaInicio)->startOfDay();
        $fechaActual = Carbon::now()->startOfDay();
        return $fechaInicio->diffInDays($fechaActual, false);
    }

    public function obtenerEstadoPlazo($fechaInicio)
    {
        $dias = $this->calcularDiasTranscurridos($fechaInicio);
        
        if ($dias <= 1) {
            return ['estado' => 'en_plazo', 'color' => 'green', 'texto' => 'En plazo', 'dias' => $dias];
        } elseif ($dias == 2) {
            return ['estado' => 'cerca_vencimiento', 'color' => 'yellow', 'texto' => 'Cerca de vencimiento', 'dias' => $dias];
        } else {
            return ['estado' => 'vencido', 'color' => 'red', 'texto' => 'Vencido', 'dias' => $dias];
        }
    }

    public function guardarObservaciones()
    {
        if ($this->tramiteSeleccionado && !empty($this->observaciones)) {
            $this->tramiteSeleccionado->observaciones = $this->observaciones;
            $this->tramiteSeleccionado->save();
            
            $this->observaciones = '';
            $this->mostrarObservaciones = false;
            
            session()->flash('success', 'Observaciones guardadas correctamente.');
        }
    }

    public function render()
    {
        return view('livewire.panel-principal');
    }
}
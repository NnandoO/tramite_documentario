<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Tramite;
use App\Models\User;
use App\Models\Notificacion; // Asegúrate de importar tu modelo Notificacion
use Illuminate\Support\Facades\Auth;

class DerivarTramite extends Component
{
    public $tramiteId;
    public $tramite;

    public $destinatariosIds = [];
    public $comentario = '';

    public function mount($tramiteId)
    {
        $this->tramiteId = $tramiteId;
        $this->tramite = Tramite::findOrFail($tramiteId);
    }

    public function derivarTramite()
    {
        if (in_array($this->tramite->estado, ['Derivado', 'Finalizado'])) {
            session()->flash('error', 'El trámite no puede ser derivado.');
            return;
        }

        $this->validate([
            'destinatariosIds' => 'required|array|min:1',
            'destinatariosIds.*' => 'exists:users,id',
            'comentario' => 'nullable|string|max:500',
        ]);

        $nuevoResponsableId = $this->destinatariosIds[0];
        $usuarioDestino = User::find($nuevoResponsableId); // Obtiene el usuario al que se deriva

        // Actualiza el trámite: ACTUALIZAMOS funcionario_destinatario con el email correcto!
        $this->tramite->funcionario_destinatario = $usuarioDestino->email;
        // NO tocar user_id porque no es el campo que usa para bandeja
        $this->tramite->estado = 'Derivado';
        $this->tramite->save();

        // Crear notificación para el NUEVO responsable
        // Se detalla A QUIÉN se deriva el trámite
        Notificacion::create([
            'user_id' => $nuevoResponsableId, // ID del usuario que recibe la notificación
            'titulo' => 'Trámite derivado a usted',
            'mensaje' => "El trámite #{$this->tramite->id} (tipo: {$this->tramite->documento}) ha sido derivado a usted por " . Auth::user()->name . ". Comentario: " . ($this->comentario ?: 'Sin comentarios.'),
            'visto' => false,
        ]);

        // Opcional: Crear una notificación para el USUARIO QUE DERIVA, informando a quién lo derivó.
        Notificacion::create([
            'user_id' => Auth::id(), // El usuario que está derivando
            'titulo' => 'Trámite derivado con éxito',
            'mensaje' => "Usted ha derivado el trámite #{$this->tramite->id} (tipo: {$this->tramite->documento}) a {$usuarioDestino->name}.",
            'visto' => false,
        ]);

        // Emitir evento para refrescar la campana de notificaciones de TODOS LOS USUARIOS AFECTADOS
        // Esto solo es necesario si estás usando broadcasting en tiempo real (Laravel Echo)
        // Para refrescar la campana del usuario actual o del destino, puedes usar $this->emit/dispatch
        if (method_exists($this, 'dispatch')) {
            // Livewire 3.x
            $this->dispatch('notificacionCreada'); // Refresca la campana del usuario actual
            // Si necesitas notificar al otro usuario en tiempo real sin recargar, necesitarás Laravel Echo y broadcasting
        } else {
            // Livewire 2.x
            $this->emit('notificacionCreada');
        }

        session()->flash('success', 'El trámite ha sido derivado correctamente.');
        return redirect()->route('panel.principal');
    }

    public function render()
    {
        // ... (Tu lógica existente para cargar usuarios filtrados)
        $usuariosFiltrados = User::where('id', '!=', Auth::id()) // No mostrar el usuario actual
            ->orderBy('name')
            ->get();

        return view('livewire.derivar-tramite', [
            'usuariosFiltrados' => $usuariosFiltrados,
        ]);
    }
}
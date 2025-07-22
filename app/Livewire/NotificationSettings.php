<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Notificacion;
use App\Models\NotificationPreference; // Importa el nuevo modelo
use Illuminate\Support\Facades\Auth;

class Notificaciones extends Component
{
    public $open = false; // Controla la visibilidad del modal principal de notificaciones
    public $notificaciones;
    public $showPreferences = false; // Controla la visibilidad de la sección de preferencias

    // Escucha el evento 'notificacionCreada' (para refrescar la lista)
    // Escucha el evento 'openNotificationSettings' para abrir la sección de preferencias
    // Escucha el evento 'closeNotificationSettings' para cerrar la sección de preferencias
    protected $listeners = [
        'notificacionCreada' => 'actualizarNotificaciones',
        'openNotificationSettings' => 'openNotificationSettings',
        'closeNotificationSettings' => 'closeNotificationSettings',
    ];

    /**
     * Se ejecuta al iniciar el componente. Carga las notificaciones del usuario.
     */
    public function mount()
    {
        $this->cargarNotificaciones();
    }

    /**
     * Carga las notificaciones del usuario autenticado, ordenadas por fecha de creación.
     */
    public function cargarNotificaciones()
    {
        $this->notificaciones = Notificacion::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();
    }

    /**
     * Alterna la visibilidad del modal principal de notificaciones.
     * Cierra la sección de preferencias si está abierta.
     */
    public function toggle()
    {
        $this->open = !$this->open;
        if (!$this->open) { // Si se cierra el modal principal, asegúrate de cerrar también las preferencias
            $this->showPreferences = false;
        }
    }

    /**
     * Marca una notificación específica como vista y recarga la lista.
     */
    public function marcarComoVista($id)
    {
        $notificacion = Notificacion::where('id', $id)
            ->where('user_id', Auth::id())
            ->first();

        if ($notificacion) {
            $notificacion->visto = true;
            $notificacion->save();
            $this->cargarNotificaciones(); // Recarga la lista para que el contador se actualice
        }
    }

    /**
     * Método para ser llamado por el listener para actualizar la lista de notificaciones.
     */
    public function actualizarNotificaciones()
    {
        $this->cargarNotificaciones();
    }

    /**
     * Abre la sección de preferencias de notificación.
     */
    public function openNotificationSettings()
    {
        $this->showPreferences = true;
    }

    /**
     * Cierra la sección de preferencias de notificación.
     */
    public function closeNotificationSettings()
    {
        $this->showPreferences = false;
        // Opcional: podrías recargar las notificaciones aquí si las preferencias afectan qué se muestra
    }

    /**
     * Renderiza la vista del componente.
     */
    public function render()
    {
        // Calcula el número de notificaciones no vistas
        $noVistas = $this->notificaciones->where('visto', false)->count();

        // Pasa los datos a la vista
        return view('livewire.notificaciones', [
            'noVistas' => $noVistas,
        ]);
    }
}
<?php

namespace App\Notifications;

use App\Models\SolicitudExpediente;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NuevaSolicitudExpedienteNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(public SolicitudExpediente $solicitud)
    {
    }

    public function via($notifiable): array
    {
        return ['mail', 'database'];
    }

    public function toMail($notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject(__('Nueva Solicitud de Expediente'))
            ->line(__('Nombre del solicitante: :name', ['name' => $this->solicitud->nombre_solicitante]))
            ->line(__('Código de expediente: :code', ['code' => $this->solicitud->codigo_expediente]))
            ->line(__('Motivo: :motivo', ['motivo' => $this->solicitud->motivo ?? '-']))
            ->line(__('Fecha: :date', ['date' => $this->solicitud->fecha->format('Y-m-d')]))
            ->line(__('Por favor revise la solicitud en el sistema.'));
    }

    public function toArray($notifiable): array
    {
        return [
            'nombre_solicitante' => $this->solicitud->nombre_solicitante,
            'codigo_expediente' => $this->solicitud->codigo_expediente,
            'motivo' => $this->solicitud->motivo,
            'fecha' => $this->solicitud->fecha->format('Y-m-d'),
        ];
    }
}

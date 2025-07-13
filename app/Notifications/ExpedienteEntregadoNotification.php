<?php

namespace App\Notifications;

use App\Models\ExpedienteEntregado;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Storage;

class ExpedienteEntregadoNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(public ExpedienteEntregado $entrega)
    {
    }

    public function via($notifiable): array
    {
        return ['mail', 'database'];
    }

    public function toMail($notifiable): MailMessage
    {
        return (new MailMessage())
            ->subject(__('Copia de expediente disponible'))
            ->line(__('Se ha cargado una copia de su expediente solicitado.'))
            ->action(__('Descargar'), url(Storage::url($this->entrega->ruta)));
    }

    public function toArray($notifiable): array
    {
        return [
            'entrega_id' => $this->entrega->id,
            'ruta' => $this->entrega->ruta,
        ];
    }
}

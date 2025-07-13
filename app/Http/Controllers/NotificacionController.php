<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreNotificacionRequest;
use App\Models\ExpedienteEntregado;
use App\Models\NotificacionSolicitud;
use App\Models\NotificacionHistorial;

class NotificacionController extends Controller
{
    public function store(StoreNotificacionRequest $request, ExpedienteEntregado $entrega)
    {
        $solicitud = $entrega->solicitud;

        $notificacion = NotificacionSolicitud::create([
            'expediente_entregado_id' => $entrega->id,
            'solicitud_id' => $solicitud->id,
            'operador_id' => $request->user()->id,
            'enviado_at' => now(),
            'estado' => 'enviada',
        ]);

        $solicitud->update(['status' => 'Aprobada – Enviada para notificación']);

        NotificacionHistorial::create([
            'notificacion_id' => $notificacion->id,
            'operador_id' => $request->user()->id,
            'accion' => 'enviada',
            'created_at' => now(),
        ]);

        return back()->with('success', __('Solicitud de notificación generada.'));
    }

    public function confirm(NotificacionSolicitud $notificacion)
    {
        $notificacion->update([
            'estado' => 'realizada',
            'realizado_at' => now(),
        ]);

        $notificacion->solicitud->update(['status' => 'Entregado – Notificado']);

        NotificacionHistorial::create([
            'notificacion_id' => $notificacion->id,
            'operador_id' => auth()->id(),
            'accion' => 'confirmada',
            'created_at' => now(),
        ]);

        return back()->with('success', __('Notificación confirmada.'));
    }
}


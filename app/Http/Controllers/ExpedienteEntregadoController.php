<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreExpedienteEntregadoRequest;
use App\Models\Expediente;
use App\Models\ExpedienteEntregado;
use App\Models\AuditEntrega;
use App\Models\SolicitudExpediente;
use App\Notifications\ExpedienteEntregadoNotification;
use Illuminate\Support\Facades\Storage;

class ExpedienteEntregadoController extends Controller
{
    public function show(ExpedienteEntregado $entrega)
    {
        return view('operador.entregas.show', compact('entrega'));
    }
    public function create(int $id)
    {
        $solicitud = SolicitudExpediente::findOrFail($id);

        return view('operador.entregados.create', compact('solicitud'));
    }

    public function store(StoreExpedienteEntregadoRequest $request, int $id)
    {
        $solicitud = SolicitudExpediente::findOrFail($id);
        $expediente = Expediente::where('codigo', $solicitud->codigo_expediente)->firstOrFail();

        foreach ($request->file('files') as $file) {
            $path = $file->store('entregas');

            $entrega = ExpedienteEntregado::create([
                'expediente_id' => $expediente->id,
                'solicitud_id' => $solicitud->id,
                'ruta' => $path,
                'user_id' => $request->user()->id,
                'visible_para_usuario' => false,
            ]);

            AuditEntrega::create([
                'expediente_id' => $expediente->id,
                'solicitante_id' => $entrega->user_id,
                'operador_id' => $request->user()->id,
                'delivered_at' => now(),
            ]);
        }

        $solicitud->update(['status' => SolicitudExpediente::APPROVED]);

        return redirect()->route('operador.solicitudes.show', $solicitud)
            ->with('success', __('Expediente entregado correctamente.'));
    }

    public function notify(ExpedienteEntregado $entrega)
    {
        $entrega->update(['visible_para_usuario' => true]);

        $entrega->user->notify(new ExpedienteEntregadoNotification($entrega));

        return back()->with('success', __('Usuario notificado correctamente.'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\SolicitudExpedienteRequest;
use App\Models\SolicitudExpediente;
use App\Models\Tramite;
use App\Models\Facultad;
use App\Models\Expediente;
use App\Models\User;
use App\Notifications\NuevaSolicitudExpedienteNotification;
use Illuminate\Http\Request;

class SolicitudController extends Controller
{
    public function create(Request $request)
    {
        $tramites = Tramite::orderBy('nombre')->pluck('nombre', 'id');
        $facultades = Facultad::orderBy('nombre')->pluck('nombre', 'id');

        $codigo = $request->input('codigo_expediente');
        $isRestricted = false;
        if ($codigo) {
            $isRestricted = (bool) Expediente::where('codigo', $codigo)
                ->value('restringido');
        }

        return view('expedientes.solicitar', compact('tramites', 'facultades', 'isRestricted'));
    }

    public function store(SolicitudExpedienteRequest $request)
    {
        $solicitud = SolicitudExpediente::create([
            'nombre_solicitante' => $request->input('nombre_solicitante'),
            'codigo_expediente'  => $request->input('codigo_expediente'),
            'tipo_tramite_id'    => $request->input('tipo_tramite'),
            'facultad_id'        => $request->input('facultad'),
            'fecha'              => $request->input('fecha'),
            'motivo'             => $request->input('motivo'),
            'status'             => SolicitudExpediente::PENDING,
            'observaciones'      => $request->input('observaciones'),
        ]);

        $operators = User::where('role_id', 4)->get();
        foreach ($operators as $operator) {
            $operator->notify(new NuevaSolicitudExpedienteNotification($solicitud));
        }

        return redirect()
            ->route('expedientes.solicitar')
            ->with('success', __('Solicitud registrada correctamente.'));
    }
}

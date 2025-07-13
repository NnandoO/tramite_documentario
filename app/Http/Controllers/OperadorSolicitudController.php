<?php

namespace App\Http\Controllers;

use App\Models\SolicitudExpediente;
use Illuminate\Http\Request;

class OperadorSolicitudController extends Controller
{
    public function index()
    {
        $solicitudes = SolicitudExpediente::where('status', SolicitudExpediente::PENDING)
            ->latest()
            ->get();

        return view('operador.solicitudes.index', compact('solicitudes'));
    }

    public function show(SolicitudExpediente $solicitud)
    {
        return view('operador.solicitudes.show', compact('solicitud'));
    }

    public function evaluate(SolicitudExpediente $solicitud)
    {
        return view('operador.solicitudes.evaluate', compact('solicitud'));
    }
}

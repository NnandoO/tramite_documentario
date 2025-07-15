<?php

namespace App\Http\Controllers\Operador;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ExpedienteController extends Controller
{
    // Pantalla: Verificación de expediente
    public function verificar($id)
    {
        // Aquí se cargarán los requisitos asociados al expediente con ID $id
        return view('operador.verificacion', compact('id'));
    }

    // POST: Guardar verificación
    public function guardarVerificacion(Request $request, $id)
    {
        // Aquí se procesarán los datos del formulario de verificación
    }

    // Pantalla: Observaciones del expediente
    public function observaciones($id)
    {
        return view('operador.observaciones', compact('id'));
    }

    // POST: Guardar observaciones
    public function guardarObservaciones(Request $request, $id)
    {
        // Aquí se guardarán las observaciones del expediente
    }
}

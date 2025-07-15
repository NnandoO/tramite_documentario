<?php

namespace App\Http\Controllers\Operador;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ExpedienteController extends Controller
{
    // Pantalla: Verificación de expediente
    public function verificar($id){
        $expediente = \App\Models\Expediente::with('usuario')->findOrFail($id);

        $requisitos = \DB::table('expediente_requisito')
            ->where('expediente_id', $id)
            ->join('requisitos', 'requisitos.id', '=', 'expediente_requisito.requisito_id')
            ->select('expediente_requisito.*', 'requisitos.nombre as nombre_requisito', 'requisitos.id as requisito_id')
            ->get();

        return view('operador.verificacion', [
            'expediente' => $expediente,
            'requisitos' => $requisitos
        ]);
    }

    public function rechazarExpediente(Request $request, $id){
        $expediente = \App\Models\Expediente::findOrFail($id);

        // Actualizar todos los requisitos asociados como 'No Cumple'
        \App\Models\ExpedienteRequisito::where('expediente_id', $id)
        ->update(['estado' => 'No Cumple', 'observacion' => 'Rechazado por el operador.']);

        // También podrías actualizar un estado general del expediente si lo deseas
        $expediente->estado = 'Rechazado';
        $expediente->save();

        return redirect()
            ->route('operador.expediente.verificar', $id)
            ->with('success', 'Expediente rechazado correctamente.');
    }


    // POST: Guardar verificación
    // POST: Guardar verificación
    public function guardarVerificacion(Request $request, $id){
        $expediente = \App\Models\Expediente::findOrFail($id);

        // Actualizamos el estado del expediente a "Validado"
        $expediente->estado = 'Validado';
        $expediente->save();

        return redirect()
            ->route('operador.expediente.verificar', $id)
            ->with('success', 'Expediente validado correctamente.');
    }



    // Pantalla: Observaciones del expediente
    public function observaciones($expediente_id, $requisito_id){
        $expediente = \App\Models\Expediente::findOrFail($expediente_id);
        $requisito = \App\Models\Requisito::findOrFail($requisito_id);

        // Buscar relación para mostrar observación previa si ya existe
        $pivot = \App\Models\ExpedienteRequisito::where('expediente_id', $expediente_id)
                    ->where('requisito_id', $requisito_id)
                    ->firstOrFail();

        return view('operador.observaciones', compact('expediente', 'requisito', 'pivot'));
    }

    // POST: Guardar observaciones
    public function guardarObservacion(Request $request, $expediente_id, $requisito_id){
        $request->validate([
            'observacion' => 'nullable|string|max:1000',
        ]);

        $pivot = \App\Models\ExpedienteRequisito::where('expediente_id', $expediente_id)
                    ->where('requisito_id', $requisito_id)
                    ->firstOrFail();

        $pivot->observacion = $request->observacion;
        $pivot->estado = 'No Cumple';
        $pivot->save();

        return redirect()
            ->route('operador.expediente.verificar', $expediente_id)
            ->with('success', 'Observación registrada correctamente.');
    }

}

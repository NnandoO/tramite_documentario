<?php

namespace App\Http\Controllers;

use App\Models\Tramite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class TramiteController extends Controller
{
    public function index()
    {
        $tramites = Tramite::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();

        return view('tramites.index', compact('tramites'));
    }

    public function edit(Tramite $tramite)
    {
        if (!in_array($tramite->estado, ['Enviado', 'Pendiente de Revisión'])) {
            return back()->with('error', 'Este trámite no puede ser editado en su estado actual.');
        }

        return view('tramites.edit', compact('tramite'));
    }

    public function update(Request $request, Tramite $tramite)
    {
        // Validación de acceso
        if ($tramite->user_id !== Auth::id()) {
            abort(403);
        }

        // Validar que el trámite esté en un estado editable
        if (!in_array($tramite->estado, ['Enviado', 'Pendiente de Revisión'])) {
            return back()->with('error', 'Este trámite no puede ser editado en su estado actual.');
        }

        // Validación según el tipo de trámite
        $rules = [];
        $messages = [];

        if (str_contains($tramite->tipo_tramite, 'CAMBIO DE ASESOR')) {
            $rules['nuevo_asesor'] = 'required|string|max:255';
            $rules['justificacion'] = 'required|string|max:1000';
            $messages = [
                'nuevo_asesor.required' => 'El campo nuevo asesor es obligatorio.',
                'justificacion.required' => 'Debe proporcionar una justificación para el cambio de asesor.',
            ];
        } elseif (str_contains($tramite->tipo_tramite, 'DESIGNACIÓN DE JURADO')) {
            $rules['titulo_proyecto'] = 'required|string|max:500';
            $rules['asesor_actual'] = 'required|string|max:255';
            $messages = [
                'titulo_proyecto.required' => 'El título del proyecto es obligatorio.',
                'asesor_actual.required' => 'El nombre del asesor actual es obligatorio.',
            ];
        } elseif (str_contains($tramite->tipo_tramite, 'CARTA DE NO ADEUDO')) {
            $rules['tipo_no_adeudo'] = 'required|in:LABORATORIO,BIBLIOTECA';
            $messages = [
                'tipo_no_adeudo.required' => 'Debe seleccionar el tipo de no adeudo.',
                'tipo_no_adeudo.in' => 'El tipo de no adeudo seleccionado no es válido.',
            ];
        }

        // Validación para documentos adjuntos
        $rules['documentos'] = 'sometimes|array';
        $rules['documentos.*'] = 'file|mimes:pdf|max:5120'; // máximo 5MB por archivo
        $messages['documentos.*.mimes'] = 'Los documentos deben estar en formato PDF.';
        $messages['documentos.*.max'] = 'Cada documento no debe exceder los 5MB.';

        // Realizar la validación
        $validated = $request->validate($rules, $messages);

        // Actualizar datos básicos
        $updateData = collect($validated)
            ->except('documentos')
            ->toArray();

        // Manejar documentos adjuntos
        if ($request->hasFile('documentos')) {
            $documentos = [];
            foreach ($request->file('documentos') as $documento) {
                $path = $documento->store('tramites/' . $tramite->id, 'public');
                $documentos[] = $path;
            }

            // Mantener documentos existentes que no fueron eliminados
            if ($tramite->documentos) {
                $documentosExistentes = json_decode($tramite->documentos);
                $documentosAEliminar = $request->input('eliminar_documento', []);

                foreach ($documentosExistentes as $doc) {
                    if (!in_array($doc, $documentosAEliminar)) {
                        $documentos[] = $doc;
                    } else {
                        // Eliminar el archivo físico
                        Storage::disk('public')->delete($doc);
                    }
                }
            }

            $updateData['documentos'] = json_encode($documentos);
        }

        // Actualizar el trámite
        $tramite->update($updateData);

        // Registrar la actualización en el historial
        $tramite->historial()->create([
            'accion' => 'Actualización',
            'descripcion' => 'El trámite fue actualizado por el solicitante.',
            'usuario_id' => Auth::id()
        ]);

        return redirect()->route('tramites.show', $tramite)
            ->with('success', 'El trámite ha sido actualizado correctamente.');
    }

    public function show(Tramite $tramite)
    {
        return view('tramites.show', compact('tramite'));
    }
}

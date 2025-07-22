<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class G1_DocumentosController extends Controller
{
    // Cargar la vista con una lista estática de expedientes
    public function index()
    {
        $expedientes = [
            ['id' => 1, 'nombre' => 'Expediente A'],
            ['id' => 2, 'nombre' => 'Expediente B'],
            ['id' => 3, 'nombre' => 'Expediente C'],
        ];

        return view('Administrador.carga_documentos', compact('expedientes'));
    }

    // Procesar archivos subidos
    public function subir(Request $request)
    {
        $request->validate([
            'expediente_id' => 'required',
            'documentos.*' => 'required|file|mimes:pdf,jpg,jpeg|max:2048',
        ]);

        foreach ($request->file('documentos') as $archivo) {
            $nombre = $archivo->getClientOriginalName();
            $archivo->storeAs('public/documentos', $nombre);
        }

        return redirect()->route('carga.documentos')->with('success', 'Documentos cargados correctamente.');
    }
}

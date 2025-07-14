<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TramiteController extends Controller
{
    public function showRecordForm()
    {
        return view('tramites.record_academico');
    }

    public function submitRecordForm(Request $request)
    {
        $request->validate([
            'sustento' => 'required|string',
            'archivo1' => 'required|file',
            'archivo2' => 'required|file',
        ]);

        // Guardar archivos
        $path1 = $request->file('archivo1')->store('tramites');
        $path2 = $request->file('archivo2')->store('tramites');

        // Aquí podrías guardar los datos en la base de datos

        return view('tramites.enviado', [
            'archivo1' => $path1,
            'archivo2' => $path2,
        ]);
    }

    public function showConstOrdForm()
    {
        return view('tramites.constancia_orden');
    }

    public function submitConstOrdForm(Request $request)
    {
        $request->validate([
            'sustento' => 'required|string',
            'archivo1' => 'required|file',
            'archivo2' => 'required|file',
        ]);

        // Guardar archivos
        $path1 = $request->file('archivo1')->store('tramites');
        $path2 = $request->file('archivo2')->store('tramites');

        // Aquí podrías guardar los datos en la base de datos

        return view('tramites.enviado', [
            'archivo1' => $path1,
            'archivo2' => $path2,
        ]);
    }
}

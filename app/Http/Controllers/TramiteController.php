<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TramiteController extends Controller
{
    public function index()
    {
        $tramites = [
            ['id' => 1, 'nombre' => 'Trámite 1'],
            ['id' => 2, 'nombre' => 'Trámite 2'],
            ['id' => 3, 'nombre' => 'Trámite 3'],
        ];

        return view('tramites.lista', compact('tramites'));
    }

    public function show($id)
    {
        $datos = [
            1 => [
                'titulo' => 'AMPLIACIÓN DE PLAZO PARA CULMINACIÓN DE EJECUCIÓN DE TESIS',
                'detalles' => [
                    'duracion' => '4 días',
                    'area' => 'Unidad de Administración Documentaria',
                    'dependencia' => 'Sin asignar'
                ],
                'requisitos' => [
                    'SOLICITUD DIRIGIDA AL DECANO DE LA FACULTAD',
                    'INFORME JUSTIFICATORIO DEL ASESOR',
                    'PAGO POR DERECHO DE TRÁMITE DOCUMENTARIO'
                ]
            ],
            2 => [
                'titulo' => 'CAMBIO DE TÍTULO DEL PLAN DE TESIS',
                'detalles' => [
                    'duracion' => '5 días',
                    'area' => 'Unidad de Administración Documentaria',
                    'dependencia' => 'Sin asignar'
                ],
                'requisitos' => [
                    'SOLICITUD DIRIGIDA AL DECANO DE LA FACULTAD',
                    'INFORME JUSTIFICATORIO DEL ASESOR',
                    'PAGO POR DERECHO DE TRÁMITE DOCUMENTARIO'
                ]
            ],
            3 => [
                'titulo' => 'OTROS TRÁMITES',
                'detalles' => [
                    'duracion' => '10 días',
                    'area' => 'Unidad de Administración Documentaria',
                    'dependencia' => 'Sin asignar'
                ],
                'requisitos' => [
                    'RECIBO',
                    'SOLICITUD',
                    'ANEXOS'
                ]
            ],
        ];

        if (!isset($datos[$id])) {
            abort(404);
        }

        $tramite = array_merge(['id' => $id], $datos[$id]);

        // Retornar la vista correspondiente al ID
        switch ($id) {
            case 1:
                return view('tramites.Ampliacion-de-plazo-para-culminacion-de-ejecucion-de-tesis', compact('tramite'));
            case 2:
                return view('tramites.Cambio-de-titulo-del-plan-de-tesis', compact('tramite'));
            case 3:
                return view('tramites.Otros-tramites', compact('tramite'));
            default:
                abort(404);
        }
    }

    public function store(Request $request, $id)
    {
        $request->validate([
            'archivo1' => 'required|file',
            'archivo2' => 'nullable|file',
            'archivo3' => 'nullable|file',
            'sustento' => 'required|string',
        ]);

        // Simulación de guardado de archivos (descomenta si deseas que se guarden en storage/app/tramites)
        /*
        $archivo1 = $request->file('archivo1')->store('tramites');
        $archivo2 = $request->file('archivo2')?->store('tramites');
        $archivo3 = $request->file('archivo3')?->store('tramites');
        */

        return back()->with('success', 'Trámite enviado correctamente.');
    }
}

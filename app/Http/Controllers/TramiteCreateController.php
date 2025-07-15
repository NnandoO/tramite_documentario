<?php

namespace App\Http\Controllers;

use App\Models\Tramite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TramiteCreateController extends Controller
{
    protected $tiposTramite = [
        'CERTIFICADO DE ESTUDIOS DE PREGRADO: FORMATO 1' => [
            'duracion' => '5 días',
            'descripcion' => 'CERTIFICADO DE ESTUDIOS DE PREGRADO: FORMATO 1',
            'requisitos' => [
                'SOLICITUD DIRIGIDA AL JEFE DE LA UNIDAD DE GESTIÓN ACADÉMICA',
                'UNA (01) FOTOGRAFÍA ACTUAL CON TERNO OSCURO EN FONDO BLANCO Y A COLORES (FORMATO JPG)',
                'PAGO POR DERECHO DE FORMATO 1 (POR HOJA) ----- S/. 20.00',
                '(culmino dentro de los dos años) /dos formatos 10 a 14 ciclos (POR HOJA)',
                'PAGO POR DERECHO DE TRÁMITE DOCUMENTARIO ----- S/. 3.00'
            ],
            'documentos' => [
                'SOLICITUD DIRIGIDA AL JEFE DE LA UNIDAD DE GESTIÓN ACADÉMICA',
                'BOUCHER DEL PAGO DE TRÁMITE',
                'Foto'
            ]
        ],
        'CERTIFICADO DE PRACTICAS PRE PROFESIONALES Y PROFESIONALES' => [
            'duracion' => '3 días',
            'descripcion' => 'CERTIFICADO DE PRACTICAS PRE PROFESIONALES Y PROFESIONALES',
            'requisitos' => [
                'SOLICITUD DIRIGIDA AL DECANO',
                '1 FOTO TAMAÑO CARNE CON TERNO FONDO BLANCO',
                'RECIBO POR TRÁMITE DOCUMENTARIO - Costo: s/. 3.00',
                'RECIBO POR PAGO DE CERTIFICADO - Costo: s/. 5.00'
            ],
            'documentos' => [
                'SOLICITUD DIRIGIDA AL DECANO',
                'RECIBO POR TRAMITE',
                'Foto'
            ]
        ]
    ];

    public function create($tipo)
    {
        if (!array_key_exists($tipo, $this->tiposTramite)) {
            return redirect()->route('tramites.index')
                ->with('error', 'Tipo de trámite no válido');
        }

        $data = $this->tiposTramite[$tipo];
        $data['titulo'] = $tipo;
        $data['tipo_tramite'] = $tipo;

        return view('tramites.create', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'tipo_tramite' => 'required|string',
            'sustento' => 'required|string',
            'documentos' => 'required|array',
            'documentos.*' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048'
        ]);

        // Aquí implementarías la lógica para guardar los archivos y crear el trámite
        $tramite = new Tramite();
        $tramite->tipo_tramite = $request->tipo_tramite;
        $tramite->estado = 'Enviado';
        $tramite->fecha_envio = now();
        $tramite->user_id = Auth::id();
        $tramite->expediente = date('Y-') . str_pad(Tramite::count() + 1, 3, '0', STR_PAD_LEFT);
        $tramite->save();

        // Manejar la subida de archivos aquí

        return redirect()->route('tramites.index')
            ->with('success', 'Trámite enviado correctamente');
    }
}

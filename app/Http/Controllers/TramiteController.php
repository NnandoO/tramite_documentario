<?php

namespace App\Http\Controllers;
use App\Http\Controllers\TramiteController;

use App\Models\TramiteSolicitud;
use App\Models\TramiteArchivoSolicitud;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TramiteController extends Controller
{
    protected $tramites = [
        0 => [
            'titulo' => 'CONSTANCIA DE EXPEDITO PARA OPTAR TÍTULO PROFESIONAL',
            'descripcion' => 'CONSTANCIA DE EXPEDITO PARA OPTAR TÍTULO PROFESIONAL',
            'duracion' => '5 días hábiles',
            'area' => 'Unidad de Administración Documentaria',
            'dependencia' => 'Sin asignar',
            'requiere_foto' => false,
            'requisitos' => [
                'Solicitud dirigida al Decano de la Facultad',
                'Informe y reporte de originalidad del software detector de similitud (Turnitin) con un porcentaje máximo de similitud del 25% y firma del asesor en todas las hojas',
                'Informe de los (03) tres revisores, por lo menos dos de ellos favorables',
                'Informe de culminación de asesoría de tesis del docente asesor',
                'Constancia única de no adeudo (CUNA) con antigüedad no mayor de seis meses',
                'Constancia de inscripción del plan de tesis',
                'Diploma del grado académico de bachiller escaneado ambas caras',
                'Constancia de inscripción SUNEDU del grado académico de bachiller',
                'Declaración jurada simple de no tener antecedentes penales ni judiciales',
                'Constancia de egresado',
                'Certificado de estudios',
                'Ficha de matrícula del primer semestre',
                'Pago por derecho de constancia - Costo: S/. 5.00',
                'Pago por derecho de ficha estadística - Costo: S/. 2.00',
                'Pago por derecho de diploma de título profesional - Costo: S/. 188.00',
                'Pago por derecho de trámite documentario - Costo: S/. 3.00',
                'Archivo SUNEDU (en .rar)',
            ]
        ],
        1 => [
            'titulo' => 'CONSTANCIA DE EXPEDITO PARA GRADO DE BACHILLER',
            'descripcion' => 'CONSTANCIA DE EXPEDITO PARA GRADO DE BACHILLER',
            'duracion' => '30 días',
            'area' => 'Unidad de Administración Documentaria',
            'dependencia' => 'Sin Asignar',
            'requiere_foto' => true,
            'requisitos' => [
                'Solicitud dirigida al Decano de la Facultad',
                'Constancia de egresado',
                'Constancia de prácticas preprofesionales/internado',
                'Certificado de proyección social',
                'Certificado de estudios',
                'Certificado de ofimática',
                'Certificado de idioma extranjero o lengua nativa - nivel básico (ingresantes 2011-II)',
                'Constancia única de no adeudo (CUNA) con antigüedad no mayor de seis meses',
                'Declaración jurada simple de no tener antecedentes penales ni judiciales',
                'Ficha de matrícula del primer semestre',
                'En caso de traslado (interno y/o externo) y segunda carrera, deberán adjuntar la resolución de convalidación de asignaturas y cuadro de convalidaciones',
                'Pago por derecho de constancia - Costo: S/. 5.00',
                'Pago por derecho de diploma de bachiller - Costo: S/. 110.00',
                'Pago por derecho de diploma de título profesional - Costo: S/. 188.00',
                'Pago por derecho de ficha estadística - Costo: S/. 2.00',
                'Pago por derecho de trámite documentario - Costo: S/. 3.00',
                'Archivo SUNEDU (en .rar)',
            ]
        ],
        2 => [
            'titulo' => 'CONSTANCIA DE PRÁCTICAS PREPROFESIONALES/INTERNADO',
            'descripcion' => 'CONSTANCIA DE PRÁCTICAS PREPROFESIONALES/INTERNADO',
            'duracion' => '3 días',
            'area' => 'Unidad de Administración Documentaria',
            'dependencia' => 'Sin asignar',
            'requiere_foto' => true,
            'requisitos' => [
                'Solicitud dirigida al decano de la facultad',
                'Pago por derecho de trámite documentario - costo : s/. 3.00',
                'Pago por derecho de constancia - costo : s/. 5.00',
                'Constancias del centro de salud del internado comunitario y/o clínico (solo enfermería) - opcional',
                'Certificado de capacitación aprobado (solo enfermería) - opcional',
                'Caso de estudio clínico (solo enfermería) - opcional',
                'Instrumentos de evaluación con nota aprobatoria (solo enfermería) - opcional',
            ]
        ],
    ];

    public function listaTramites()
    {
        return view('components.listaTramites');
    }

    public function show($id)
    {
        if (!array_key_exists($id, $this->tramites)) {
            abort(404, 'Trámite no encontrado');
        }

        $tramite = $this->tramites[$id];

        $requisitosObligatorios = [];
        $requisitosOpcionales = [];

        foreach ($tramite['requisitos'] as $req) {
            if (str_contains(strtolower($req), 'opcional')) {
                $requisitosOpcionales[] = $req;
            } else {
                $requisitosObligatorios[] = $req;
            }
        }

        return view('components.tramite1', [
            'id' => $id,
            'titulo' => $tramite['titulo'],
            'descripcion' => $tramite['descripcion'],
            'duracion' => $tramite['duracion'],
            'area' => $tramite['area'],
            'dependencia' => $tramite['dependencia'],
            'requiere_foto' => $tramite['requiere_foto'],
            'requisitosObligatorios' => $requisitosObligatorios,
            'requisitosOpcionales' => $requisitosOpcionales,
        ]);
    }

    public function enviarSolicitud(Request $request, $id)
    {
        if (!array_key_exists($id, $this->tramites)) {
            abort(404, 'Trámite no encontrado');
        }

        $tramite = $this->tramites[$id];

        // Validación básica
        $rules = [
            'sustento' => 'nullable|string|max:1000',
        ];

        if ($tramite['requiere_foto']) {
            $rules['foto'] = 'required|image|max:2048';
        }

        // Validar archivos de requisitos obligatorios
        foreach ($tramite['requisitos'] as $index => $requisito) {
            $key = str_contains(strtolower($requisito), 'opcional') ? "archivo_opcional_$index" : "archivo_$index";
            $rules[$key] = 'nullable|file|max:5120'; // 5 MB máx
        }

        $validated = $request->validate($rules);

        // Subir la foto si se requiere
        $rutaFoto = null;
        if ($tramite['requiere_foto'] && $request->hasFile('foto')) {
            $rutaFoto = $request->file('foto')->store('fotos_tramites', 'public');
        }

        // Subir archivos de requisitos
        foreach ($tramite['requisitos'] as $index => $requisito) {
            $esOpcional = str_contains(strtolower($requisito), 'opcional');
            $inputName = $esOpcional ? "archivo_opcional_$index" : "archivo_$index";

            if ($request->hasFile($inputName)) {
                $archivo = $request->file($inputName);
                $rutaArchivo = $archivo->store('documentos_tramites', 'public');
            }
        }

        return redirect()->route('tramites.index')->with('success', 'Solicitud enviada correctamente.');
    }
}

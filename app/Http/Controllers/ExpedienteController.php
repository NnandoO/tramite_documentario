<?php

namespace App\Http\Controllers;

use App\Models\Dependencia;
use App\Models\Expediente;
use App\Models\Documento;
use App\Models\Tramite;
use App\Models\Facultad;
use App\Http\Requests\ValidateExpedienteMetadataRequest;
use App\Http\Requests\UploadDocumentsRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ExpedienteController extends Controller
{
    public function index(Request $request)
    {
        $query = Expediente::query();

        if ($request->filled('tipo_tramite')) {
            $query->where('tipo_tramite_id', $request->tipo_tramite);
        }
        if ($request->filled('facultad')) {
            $query->where('facultad_id', $request->facultad);
        }
        if ($request->filled('desde')) {
            $query->whereDate('fecha_expediente', '>=', $request->desde);
        }
        if ($request->filled('hasta')) {
            $query->whereDate('fecha_expediente', '<=', $request->hasta);
        }

        $expedientes = $query->orderByDesc('fecha_expediente')->get();
        $tramites = Tramite::all();
        $facultades = Facultad::all();

        return view('expedientes.index', compact('expedientes', 'tramites', 'facultades'));
    }

    public function create()
    {
        $dependencias = Dependencia::all();
        $tramites = Tramite::all();
        $facultades = Facultad::all();

        return view('expedientes.create', compact('dependencias', 'tramites', 'facultades'));
    }

    public function store(ValidateExpedienteMetadataRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        $expediente = Expediente::create([
            'nombre' => $request->input('nombre'),
            'dependencia_id' => $request->input('dependencia'),
            'tipo_tramite_id' => $validated['tipo_tramite'],
            'facultad_id' => $validated['facultad'],
            'fecha_expediente' => $validated['fecha_expediente'],
        ]);

        return redirect()
            ->route('expedientes.show', $expediente)
            ->with('success', __('Expediente archivado correctamente.'));
    }

    public function show(int $id)
    {
        $expediente = Expediente::with([
            'documentos' => function ($query) {
                $query->orderBy('uploaded_at');
            },
            'tramite',
            'facultad',
            'dependencia',
        ])->findOrFail($id);

        return view('expedientes.show', compact('expediente'));
    }

    public function uploadDocuments(UploadDocumentsRequest $request, int $id): RedirectResponse
    {
        $expediente = Expediente::findOrFail($id);

        foreach ($request->file('documents') as $file) {
            $path = $file->store('expedientes/'.$expediente->id);

            $expediente->documentos()->create([
                'ruta' => $path,
                'size' => $file->getSize(),
                'user_id' => $request->user()->id,
                'uploaded_at' => now(),
            ]);
        }

        return redirect()
            ->route('expedientes.show', $expediente)
            ->with('success', __('Documentos cargados correctamente.'));
    }
}

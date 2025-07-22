<?php

use function Livewire\Volt\{state, mount};

state(['tramite' => []]);
state(['expediente' => '']);

use Illuminate\Support\Facades\Storage;

// Método para descargar documentos
function descargarDocumento($nombreDocumento) {
    if (Storage::disk('public')->exists("documentos/{$nombreDocumento}")) {
        return response()->download(storage_path("app/public/documentos/{$nombreDocumento}"));
    }
    
    session()->flash('error', 'El documento no está disponible para descarga.');
};

mount(function ($expediente) {
    $this->expediente = $expediente;
    
    // Aquí simularemos los datos del trámite
    // En un caso real, estos datos vendrían de la base de datos
    $this->tramite = [
        'numero_expediente' => $expediente,
        'tipo_tramite' => 'Otorgamiento de Título',
        'estado' => 'En Proceso',
        'fecha_envio' => '2023-07-20',
        'funcionario' => [
            'nombre' => 'Juan Pérez',
            'cargo' => 'Secretario Académico'
        ],
        'oficina' => [
            'nombre' => 'Secretaría Académica',
            'facultad' => 'Facultad de Ingeniería'
        ],
        'dirigido_a' => 'Decano de la Facultad',
        'sustento' => 'Solicito el otorgamiento del título profesional...',
        'documentos' => [
            ['nombre' => 'Solicitud.pdf'],
            ['nombre' => 'ActaSustentacion.pdf'],
            ['nombre' => 'BoletaPago.pdf']
        ]
    ];
});

?>
<div class="p-6 bg-[#E0E0E0] min-h-screen">
    <div class="max-w-4xl mx-auto">
        <!-- Encabezado -->
        <div class="flex items-center mb-6">
            <a href="{{ route('tramites.historial') }}" class="flex items-center text-gray-600 hover:text-gray-900">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                <span>Volver al historial</span>
            </a>
        </div>

        <!-- Título y Estado -->
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-semibold">Detalle del Trámite</h1>
            <span class="px-4 py-1 rounded-full text-sm font-semibold
                {{ $tramite['estado'] === 'En Proceso' ? 'bg-blue-100 text-blue-800' : '' }}
                {{ $tramite['estado'] === 'Aprobado' ? 'bg-green-100 text-green-800' : '' }}
                {{ $tramite['estado'] === 'Pendiente de Revisión' ? 'bg-yellow-100 text-yellow-800' : '' }}
                {{ $tramite['estado'] === 'Rechazado' ? 'bg-red-100 text-red-800' : '' }}">
                {{ $tramite['estado'] }}
            </span>
        </div>

        <!-- Información del trámite -->
        <div class="bg-white rounded-lg p-6 shadow-sm mb-6">
            <h2 class="text-lg font-semibold mb-4">Información General</h2>
            
            <div class="grid grid-cols-2 gap-6">
                <!-- Columna izquierda -->
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Número de Expediente</label>
                        <p class="mt-1">{{ $tramite['numero_expediente'] }}</p>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Tipo de Trámite</label>
                        <p class="mt-1">{{ $tramite['tipo_tramite'] }}</p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Fecha de Envío</label>
                        <p class="mt-1">{{ $tramite['fecha_envio'] }}</p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Funcionario a Cargo</label>
                        <p class="mt-1">{{ $tramite['funcionario']['nombre'] }}</p>
                        <p class="text-sm text-gray-500">{{ $tramite['funcionario']['cargo'] }}</p>
                    </div>
                </div>

                <!-- Columna derecha -->
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Oficina/Dependencia</label>
                        <p class="mt-1">{{ $tramite['oficina']['nombre'] }}</p>
                        <p class="text-sm text-gray-500">{{ $tramite['oficina']['facultad'] }}</p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Dirigido a</label>
                        <p class="mt-1">{{ $tramite['dirigido_a'] }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sustento -->
        <div class="bg-white rounded-lg p-6 shadow-sm mb-6">
            <h2 class="text-lg font-semibold mb-4">Sustento del Trámite</h2>
            <p class="text-gray-700">{{ $tramite['sustento'] }}</p>
        </div>

        <!-- Documentos adjuntos -->
        <div class="bg-white rounded-lg p-6 shadow-sm">
            <h2 class="text-lg font-semibold mb-4">Documentos Adjuntos</h2>
            <div class="space-y-3">
                @foreach($tramite['documentos'] as $documento)
                <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                    <div class="flex items-center">
                        <svg class="w-6 h-6 text-gray-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                        </svg>
                        <span class="text-sm">{{ $documento['nombre'] }}</span>
                    </div>
                    <button 
                        wire:click="descargarDocumento('{{ $documento['nombre'] }}')"
                        class="px-3 py-1 text-sm text-[#22572D] font-medium bg-white rounded border border-[#22572D] hover:bg-[#22572D] hover:text-white transition-colors"
                    >
                        Descargar
                    </button>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
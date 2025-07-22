<div>
    @push('styles')
        <link rel="stylesheet" href="{{ asset('css/registroEnvioAutomatico.css') }}">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @endpush

    <div class="contenedor">
        <h2 class="titulo-seccion">ESTADO DE ENVÍO DE EXPEDIENTES</h2>

        <div class="expediente-lista">
            @forelse ($expedientes as $exp)
                <div class="expediente">
                    <div class="contenido">
                        <p class="titulo">
                            <strong>Expediente: Nº {{ $exp->codigo }}_{{ \Carbon\Carbon::parse($exp->fecha_ingreso)->year }}_{{ $exp->solicitante }}</strong>
                        </p>
                        <p>Medio: {{ $exp->medio_envio }}</p>
                        <p class="estado-ok">
                            <i class="fas fa-check-square"></i> Estado: enviado correctamente a {{ $exp->medio_envio }}
                        </p>
                        <p class="timestamp">
                            Timestamp: {{ \Carbon\Carbon::parse($exp->fecha_envio)->format('Y-m-d / H:i') }}
                        </p>
                    </div>
                </div>
            @empty
                <p class="text-gray-600">No hay expedientes enviados aún.</p>
            @endforelse
        </div>

        <!-- Navegación personalizada -->
        <div class="navegacion text-center mt-4">
            <button wire:click="anterior" @if($paginaActual <= 1) disabled @endif title="Anterior">
                <i class="fas fa-step-backward"></i>
            </button>

            <span class="mx-4">Página {{ $paginaActual }} de {{ $totalPaginas }}</span>

            <button wire:click="siguiente" @if($paginaActual >= $totalPaginas) disabled @endif title="Siguiente">
                <i class="fas fa-step-forward"></i>
            </button>
        </div>
    </div>
</div>

<div>
    @push('styles')
        <link rel="stylesheet" href="{{ asset('css/verificacionExpediente.css') }}">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @endpush

    <main class="main-content p-6">
        <h2 class="text-2xl font-bold mb-4 text-gray-800 dark:text-white">Verificación de Expedientes</h2>

        {{-- MENSAJE DE ÉXITO --}}
        @if (session('success'))
            <div 
                x-data="{ show: true }" 
                x-init="setTimeout(() => show = false, 3000)" 
                x-show="show"
                x-transition
                class="bg-green-100 border border-green-400 text-green-700 px-4 py-2 rounded mb-4"
            >
                {{ session('success') }}
            </div>
        @endif


        <!-- Lista de expedientes con scroll -->
        <div class="tabla-scroll">
            <table class="expedientes-table w-full border-collapse">
                <thead>
                    <tr class="bg-gray-100 dark:bg-zinc-700 text-left">
                        <th class="p-2">N° Expediente</th>
                        <th class="p-2">Solicitante</th>
                        <th class="p-2">Fecha Ingreso</th>
                        <th class="p-2">Estado</th>
                        <th class="p-2">Acción</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($expedientes as $exp)
                        <tr class="{{$exp->status->name === 'Aprobado' ? 'estado-validado' : ($exp->status->name === 'Rechazado' ? 'estado-rechazado' :
                                ($exp->status->name === 'Canalizado' ? 'estado-canalizado' :
                                ($exp->status->name === 'Finalizado' ? 'estado-finalizado' :
                                ($exp->status->name === 'Archivado' ? 'estado-archivado' : 'estado-pendiente'))))}}">
                            <td class="p-2">{{ $exp->codigo }}</td>
                            <td class="p-2">{{ $exp->solicitante }}</td>
                            <td class="p-2">{{ $exp->fecha_ingreso }}</td>
                            <td class="p-2">{{ $exp->status->name }}</td>
                            <td class="p-2 flex gap-2">
                                <button class="btn-ver" wire:click="seleccionarExpediente({{ $exp->id }})">Ver</button>
                                @if ($exp->status->name === 'En Curso' || $exp->status->name === 'Progreso')
                                    <a href="{{ route('registroObservaciones', ['expedienteId' => $exp->id]) }}"
                                       class="btn-observar bg-blue-500 text-white px-2 py-1 rounded text-sm hover:bg-blue-600">
                                        Observar
                                    </a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Detalle del expediente -->
        @if ($expedienteSeleccionado)
            <div class="expediente-detalle mt-8">
                <h3 class="text-xl font-semibold mb-4">Detalle del Expediente</h3>

                <div class="detalle-info grid gap-2 mb-4">
                    <div><strong>N° Expediente:</strong> {{ $expedienteSeleccionado->codigo }}</div>
                    <div><strong>Solicitante:</strong> {{ $expedienteSeleccionado->solicitante }}</div>
                    <div><strong>Fecha Ingreso:</strong> {{ $expedienteSeleccionado->fecha_ingreso }}</div>
                    <div><strong>Sumilla:</strong> {{ $expedienteSeleccionado->sumilla }}</div>
                    <div><strong>Estado:</strong> {{ $expedienteSeleccionado->status->name }}</div>
                </div>

                @if ($expedienteSeleccionado->status->name === 'En Curso' || $expedienteSeleccionado->status->name === 'Progreso')
                    <div class="acciones flex gap-4">
                        <button wire:click="validarExpediente"
                                class="btn validar-btn bg-green-600 text-white px-4 py-2 rounded">
                            VALIDAR
                        </button>
                        <button wire:click="rechazarExpediente"
                                class="btn rechazar-btn bg-red-600 text-white px-4 py-2 rounded">
                            RECHAZAR
                        </button>
                    </div>
                @elseif ($expedienteSeleccionado->status->name === 'Aprobado')
                    <div class="acciones mt-4">
                        <a href="{{ route('remisionExpediente', ['expedienteId' => $expedienteSeleccionado->id]) }}"
                           class="btn btn-remitir bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">
                            REMITIR EXPEDIENTE
                        </a>
                    </div>
                @endif
            </div>
        @endif
    </main>
</div>

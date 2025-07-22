<div>
    @push('styles')
        <link rel="stylesheet" href="{{ asset('css/canalizarEnvio.css') }}">
    @endpush

    <div class="main-content">
        <h2 class="text-2xl font-bold mb-4">Canalizar envío a otro aplicativo</h2>

        @if ($mensajeExito)
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-2 rounded mb-4">
                {{ $mensajeExito }}
            </div>
        @endif

        @if ($mensajeError)
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-2 rounded mb-4">
                {{ $mensajeError }}
            </div>
        @endif

        <div class="tabla-scroll mb-6">
            <table class="expedientes-table w-full border-collapse">
                <thead>
                    <tr class="bg-gray-100 text-left">
                        <th class="p-2">N° Expediente</th>
                        <th class="p-2">Solicitante</th>
                        <th class="p-2">Fecha Envío</th>
                        <th class="p-2">Acción</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($expedientes as $exp)
                        <tr>
                            <td class="p-2">{{ $exp->codigo }}</td>
                            <td class="p-2">{{ $exp->solicitante }}</td>
                            <td class="p-2">{{ \Carbon\Carbon::parse($exp->fecha_envio)->format('d/m/Y H:i') }}</td>
                            <td class="p-2">
                                <button wire:click="seleccionarExpediente({{ $exp->id }})"
                                        class="btn bg-yellow-500 text-white px-2 py-1 rounded hover:bg-yellow-600 text-sm">
                                    Seleccionar
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        @if ($expedienteSeleccionado)
            <div class="expediente-detalle mt-6">
                <h3 class="text-xl font-semibold mb-4">Datos para canalización</h3>

                <div class="mb-4">
                    <p><strong>Expediente:</strong> {{ $expedienteSeleccionado->codigo }} - {{ $expedienteSeleccionado->solicitante }}</p>
                </div>

                <div class="grid gap-4 mb-4">
                    <div>
                        <label class="block mb-1">Endpoint / URL *</label>
                        <input type="text" wire:model="endpoint" class="w-full border rounded px-2 py-1">
                    </div>
                    <div>
                        <label class="block mb-1">Usuario *</label>
                        <input type="text" wire:model="usuario" class="w-full border rounded px-2 py-1">
                    </div>
                    <div>
                        <label class="block mb-1">Token / API Key *</label>
                        <input type="text" wire:model="token" class="w-full border rounded px-2 py-1">
                    </div>
                    <div>
                        <label class="block mb-1">Cabeceras adicionales (JSON)</label>
                        <input type="text" wire:model="cabeceras" class="w-full border rounded px-2 py-1">
                    </div>
                </div>

                <div class="acciones flex gap-4 mt-4">
                    <button wire:click="enviarCanalizacion"
                            class="btn bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">
                        Enviar
                    </button>
                    <button wire:click="cancelar"
                            class="btn bg-gray-400 text-white px-4 py-2 rounded hover:bg-gray-500">
                        Cancelar
                    </button>
                </div>
            </div>
        @endif
    </div>
</div>

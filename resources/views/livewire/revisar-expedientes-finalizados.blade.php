<div>
    @push('styles')
        <link rel="stylesheet" href="{{ asset('css/revisarExpedientesFinalizados.css') }}">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @endpush

    <main class="main-content p-6">
        <h2 class="text-2xl font-bold mb-4 text-gray-800">Revisión de Expedientes Finalizados</h2>

        <!-- Lista de expedientes -->
        <div class="tabla-scroll">
            <table class="expedientes-table">
                <thead>
                    <tr class="bg-gray-100 text-left">
                        <th class="p-2">N° Expediente</th>
                        <th class="p-2">Solicitante</th>
                        <th class="p-2">Fecha Ingreso</th>
                        <th class="p-2">Estado</th>
                        <th class="p-2">Acción</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($expedientes as $exp)
                        <tr>
                            <td class="p-2">{{ $exp->codigo }}</td>
                            <td class="p-2">{{ $exp->solicitante }}</td>
                            <td class="p-2">{{ $exp->fecha_ingreso }}</td>
                            <td class="p-2">{{ $exp->estado }}</td>
                            <td class="p-2">
                                <button class="btn btn-ver" wire:click="seleccionarExpediente({{ $exp->id }})">
                                    Revisar
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-gray-500 py-4">
                                No hay expedientes para revisar.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Detalle del expediente seleccionado -->
        @if ($expedienteSeleccionado)
            <div class="expediente-detalle mt-8">
                <h3 class="text-xl font-semibold mb-4">Detalle del Expediente</h3>

                <div class="detalle-info">
                    <div><strong>N° Expediente:</strong> {{ $expedienteSeleccionado->codigo }}</div>
                    <div><strong>Solicitante:</strong> {{ $expedienteSeleccionado->solicitante }}</div>
                    <div><strong>Fecha Ingreso:</strong> {{ $expedienteSeleccionado->fecha_ingreso }}</div>
                    <div><strong>Estado Actual:</strong> {{ $expedienteSeleccionado->estado }}</div>
                    <div><strong>Observaciones:</strong> {{ $expedienteSeleccionado->observaciones }}</div>
                </div>

                <div class="form-group mb-4">
                    <label>Mensaje de notificación (opcional)</label>
                    <textarea wire:model.defer="mensajeNotificacion" rows="3" placeholder="Mensaje para el solicitante..."></textarea>
                </div>

                <div class="acciones">
                    <button wire:click="marcarComoFinalizado"
                            class="btn bg-green-600 text-white px-4 py-2 hover:bg-green-700">
                        Marcar como Finalizado
                    </button>
                    <button wire:click="cancelarSeleccion"
                            class="btn bg-gray-500 text-white px-4 py-2 hover:bg-gray-600">
                        Cancelar
                    </button>
                </div>
            </div>
        @endif
    </main>
</div>

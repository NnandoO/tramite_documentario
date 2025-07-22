<div>
    @push('styles')
        <link rel="stylesheet" href="{{ asset('css/entregarArchivar.css') }}">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @endpush

    <main class="main-content p-6">
        <h2 class="text-2xl font-bold mb-4 text-gray-800">Entrega y Archivo de Expedientes</h2>

        <!-- Mensajes -->
        @if ($mensajeExito)
            <div class="alert alert-success mb-4">{{ $mensajeExito }}</div>
        @endif
        @if ($mensajeError)
            <div class="alert alert-danger mb-4">{{ $mensajeError }}</div>
        @endif

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
                                <button class="btn btn-ver"
                                        wire:click="seleccionarExpediente({{ $exp->id }})">
                                    Seleccionar
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-gray-500 py-4">No hay expedientes para archivar.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Detalle y formulario -->
        @if ($expedienteSeleccionado)
            <div class="expediente-detalle mt-8">
                <h3 class="text-xl font-semibold mb-4">Detalle del Expediente Seleccionado</h3>

                <div class="detalle-info">
                    <div><strong>N° Expediente:</strong> {{ $expedienteSeleccionado->codigo }}</div>
                    <div><strong>Solicitante:</strong> {{ $expedienteSeleccionado->solicitante }}</div>
                    <div><strong>Fecha Ingreso:</strong> {{ $expedienteSeleccionado->fecha_ingreso }}</div>
                    <div><strong>Observaciones:</strong> {{ $expedienteSeleccionado->observaciones }}</div>
                </div>

                <div class="form-group">
                    <label>Fecha de entrega <span class="required">*</span></label>
                    <input type="date" wire:model.defer="fechaEntrega">
                    @error('fechaEntrega') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>

                <div class="form-group">
                    <label>Archivo del cargo escaneado <span class="required">*</span></label>
                    <input type="file" wire:model="archivoCargo" accept=".pdf,image/*">
                    @error('archivoCargo') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>

                <div class="form-group">
                    <label>Observación (opcional)</label>
                    <textarea wire:model.defer="observacionEntrega" rows="3" placeholder="Observaciones..."></textarea>
                    @error('observacionEntrega') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>

                <div class="acciones flex gap-4">
                    <button wire:click="archivarExpediente"
                            class="btn bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                        Archivar expediente
                    </button>
                    <button wire:click="cancelarSeleccion"
                            class="btn bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
                        Cancelar
                    </button>
                </div>
            </div>
        @endif
    </main>
</div>

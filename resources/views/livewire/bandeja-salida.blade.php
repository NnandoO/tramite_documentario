<div class="space-y-6">

        {{-- Título principal --}}
        <div class="flex items-center gap-2">
            <flux:icon.paper-airplane class="w-6 h-6 text-blue-500" />
            <h1 class="text-2xl font-semibold text-gray-800">Bandeja de Salida</h1>
        </div>

        {{-- Layout de dos columnas --}}
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            
            {{-- 🟩 Columna izquierda: Tabla de trámites enviados --}}
            <div class="rounded-lg shadow bg-white">
                <div class="p-4 border-b flex items-center justify-between">
                    <h2 class="text-lg font-semibold text-gray-700">Trámites Enviados</h2>
                    <flux:badge variant="info" size="sm">{{ count($tramites) }} trámites</flux:badge>
                </div>

                <div class="p-4 space-y-3">
                    {{-- Filtros --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                        <div>
                            <label class="block text-xs font-medium text-gray-600 mb-1">Estado</label>
                            <select wire:model="filtroEstado" class="w-full px-2 py-1 text-sm border border-gray-300 rounded-lg">
                                <option value="">-- Todos --</option>
                                @foreach($statuses as $status)
                                    <option value="{{ $status }}">{{ $status }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block text-xs font-medium text-gray-600 mb-1">Funcionario</label>
                            <input type="text" wire:model="filtroFuncionario" class="w-full px-2 py-1 text-sm border border-gray-300 rounded-lg">
                        </div>
                    </div>

                    {{-- Tabla --}}
                    <div class="max-h-96 overflow-y-auto border rounded-lg">
                        <table class="w-full text-sm text-gray-800">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th class="p-2">Código</th>
                                    <th class="p-2">Estado</th>
                                    <th class="p-2">Responsable</th>
                                    <th class="p-2">Última Acción</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($tramites as $tramite)
                                    <tr wire:click="seleccionarTramite({{ $tramite->id }})"
                                        class="cursor-pointer hover:bg-blue-50 transition-colors">
                                        <td class="p-2 font-mono text-blue-600">{{ $tramite->codigo }}</td>
                                        <td class="p-2">
                                            @php
                                                $badgeColor = match($tramite->estado) {
                                                    'Pendiente'      => 'bg-yellow-100 text-yellow-800',
                                                    'En Revisión'    => 'bg-blue-100 text-blue-800',
                                                    'Atendido'       => 'bg-indigo-100 text-indigo-800',
                                                    'Aprobado'       => 'bg-green-100 text-green-800',
                                                    'Finalizado'     => 'bg-emerald-100 text-emerald-800',
                                                    'Derivado'       => 'bg-gray-200 text-gray-800',
                                                    default          => 'bg-gray-100 text-gray-800'
                                                };
                                            @endphp
                                            <span class="inline-block px-2 py-1 text-xs font-semibold rounded-full {{ $badgeColor }}">
                                                {{ $tramite->estado }}
                                            </span>
                                        </td>
                                        <td class="p-2">{{ $tramite->funcionario_destinatario ?? '-' }}</td>
                                        <td class="p-2">{{ $tramite->updated_at->format('d/m/Y H:i') }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center text-gray-500 py-6">No se encontraron trámites</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            {{-- 🟦 Columna derecha: Detalles del trámite seleccionado --}}
            <div class="rounded-lg shadow bg-white">
                <div class="p-4 border-b">
                    <h2 class="text-lg font-semibold text-gray-700">Detalles del Trámite</h2>
                </div>

                <div class="p-6">
                    @if($tramiteSeleccionado)
                        <div class="space-y-3 text-sm text-gray-800">
                            <div><strong>Código:</strong> {{ $tramiteSeleccionado->codigo }}</div>
                            <div>
                                <strong>Estado:</strong>
                                @php
                                    $badgeColor = match($tramiteSeleccionado->estado) {
                                        'Pendiente'      => 'bg-yellow-100 text-yellow-800',
                                        'En Revisión'    => 'bg-blue-100 text-blue-800',
                                        'Atendido'       => 'bg-indigo-100 text-indigo-800',
                                        'Aprobado'       => 'bg-green-100 text-green-800',
                                        'Finalizado'     => 'bg-emerald-100 text-emerald-800',
                                        'Derivado'       => 'bg-gray-200 text-gray-800',
                                        default          => 'bg-gray-100 text-gray-800'
                                    };
                                @endphp
                                <span class="inline-block px-2 py-1 text-xs font-semibold rounded-full {{ $badgeColor }}">
                                    {{ $tramiteSeleccionado->estado }}
                                </span>
                            </div>
                            <div><strong>Responsable:</strong> {{ $tramiteSeleccionado->solicitante }}</div>
                            <div><strong>Fecha:</strong> {{ $tramiteSeleccionado->updated_at->format('d/m/Y H:i') }}</div>
                            <div><strong>Observaciones:</strong> {{ $tramiteSeleccionado->observaciones }}</div>
                        </div>
                    @else
                        <div class="text-center text-gray-500 py-10">
                            <p>Selecciona un trámite para ver sus detalles</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
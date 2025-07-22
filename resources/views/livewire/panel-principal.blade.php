<div class="space-y-6">
    <div class="flex justify-end p-4 bg-white shadow mb-4">
        @livewire('notificaciones')
    </div>

    {{-- Mensaje de éxito --}}
    @if (session()->has('success'))
        <div class="rounded bg-green-100 text-green-800 p-4 flex items-center">
            <flux:icon.check-circle class="w-5 h-5 mr-2 text-green-600" />
            {{ session('success') }}
        </div>
    @endif

    {{-- Tarjetas de resumen --}}
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
        <div class="rounded-lg shadow bg-white text-center p-4">
            <flux:icon.folder-open variant="outline" class="w-8 h-8 text-blue-500 mx-auto mb-3" />
            <div class="text-3xl font-bold">{{ $pendientes }}</div>
            <div class="text-gray-500">Pendientes</div>
        </div>

        <div class="rounded-lg shadow bg-white text-center p-4">
            <flux:icon.clock variant="outline" class="w-8 h-8 text-yellow-500 mx-auto mb-3" />
            <div class="text-3xl font-bold">{{ $enProceso }}</div>
            <div class="text-gray-500">En Proceso</div>
        </div>

        <div class="rounded-lg shadow bg-white text-center p-4">
            <flux:icon.check-circle variant="outline" class="w-8 h-8 text-green-500 mx-auto mb-3" />
            <div class="text-3xl font-bold">{{ $completados }}</div>
            <div class="text-gray-500">Completados</div>
        </div>

        <div class="rounded-lg shadow bg-white text-center p-4">
            <flux:icon.share variant="outline" class="w-8 h-8 text-cyan-500 mx-auto mb-3" />
            <div class="text-3xl font-bold">{{ $derivados }}</div>
            <div class="text-gray-500">Derivados</div>
        </div>
    </div>

    {{-- Layout de dos columnas --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        
        {{-- Columna izquierda: Bandeja de entrada --}}
        <div class="rounded-lg shadow bg-white">
            <div class="p-4 border-b flex items-center justify-between">
                <div class="flex items-center gap-2">
                    <flux:icon.inbox class="w-5 h-5 text-orange-500" />
                    <h2 class="text-lg font-semibold">Bandeja de Entrada</h2>
                </div>
                <flux:badge variant="warning" size="sm">
                    {{ count($tramitesPendientes) }} pendientes
                </flux:badge>
            </div>

            {{-- Filtro por fechas --}}
            <div class="p-4 border-b bg-gray-50">
                <div class="flex items-center gap-2 mb-3">
                    <flux:icon.calendar-days class="w-4 h-4 text-gray-600" />
                    <h3 class="text-sm font-medium text-gray-700">Filtrar por fecha</h3>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                    <div>
                        <label class="block text-xs font-medium text-gray-600 mb-1">Desde</label>
                        <input 
                            type="date" 
                            wire:model.live="fechaDesde"
                            class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                            max="{{ date('Y-m-d') }}"
                        >
                    </div>
                    
                    <div>
                        <label class="block text-xs font-medium text-gray-600 mb-1">Hasta</label>
                        <input 
                            type="date" 
                            wire:model.live="fechaHasta"
                            class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                            max="{{ date('Y-m-d') }}"
                        >
                    </div>
                </div>

                {{-- Botones de filtro --}}
                <div class="flex items-center gap-2 mt-3">
                    @if($fechaDesde || $fechaHasta)
                        <flux:button 
                            variant="outline" 
                            size="xs" 
                            icon="x-mark"
                            wire:click="limpiarFiltros"
                            class="text-gray-600 border-gray-300 hover:bg-gray-100">
                            Limpiar
                        </flux:button>
                        
                        <span class="text-xs text-gray-500">
                            @if($fechaDesde && $fechaHasta)
                                {{ \Carbon\Carbon::parse($fechaDesde)->format('d/m/Y') }} - {{ \Carbon\Carbon::parse($fechaHasta)->format('d/m/Y') }}
                            @elseif($fechaDesde)
                                Desde {{ \Carbon\Carbon::parse($fechaDesde)->format('d/m/Y') }}
                            @elseif($fechaHasta)
                                Hasta {{ \Carbon\Carbon::parse($fechaHasta)->format('d/m/Y') }}
                            @endif
                        </span>
                    @endif
                </div>
            </div>

            {{-- Lista de trámites --}}
            <div class="max-h-96 overflow-y-auto">
                @if(count($tramitesPendientes) > 0)
                    @foreach($tramitesPendientes as $tramite)
    @php
        $plazoInfo = $this->obtenerEstadoPlazo($tramite->fecha_inicio);
        $estadoTexto = '';
        if($plazoInfo['color'] == 'green') {
            $estadoTexto = 'En plazo';
        } elseif($plazoInfo['color'] == 'yellow') {
            $estadoTexto = 'Cerca de vencer';
        } else {
            $estadoTexto = 'Vencido';
        }
    @endphp
    <div wire:click="seleccionarTramite({{ $tramite->id }})" 
         class="p-4 border-b border-gray-100 hover:bg-gray-50 cursor-pointer transition-colors duration-150 {{ $tramiteSeleccionado && $tramiteSeleccionado->id == $tramite->id ? 'bg-blue-50 border-l-4 border-l-blue-500' : '' }}">
        
        <div class="flex justify-between items-start mb-2">
            <div class="flex-1">
                <div class="font-semibold text-gray-900">{{ $tramite->documento }}</div>
                <div class="text-gray-500 text-xs">{{ $tramite->codigo }}</div>
            </div>
            <div class="flex flex-col gap-1">
                <flux:badge variant="warning" size="sm">
                    {{ $tramite->estado }}
                </flux:badge>
                <div class="flex items-center gap-2">
                    <div class="w-5 h-5 rounded-full @if($plazoInfo['color'] == 'green') bg-green-500 @elseif($plazoInfo['color'] == 'yellow') bg-yellow-500 @else bg-red-500 @endif"></div>
                    <span class="text-xs font-medium @if($plazoInfo['color'] == 'green') text-green-700 @elseif($plazoInfo['color'] == 'yellow') text-yellow-700 @else text-red-700 @endif">
                        {{ $estadoTexto }}
                    </span>
                </div>
            </div>
        </div>
        
        <div class="space-y-1 text-sm">
            <div class="flex items-center text-gray-600">
                <flux:icon.user class="w-4 h-4 mr-2" />
                <span class="font-medium">Solicitante:</span>
                <span class="ml-1">{{ $tramite->solicitante }}</span>
            </div>
            <div class="flex items-center text-gray-600">
                <flux:icon.calendar-days class="w-4 h-4 mr-2" />
                <span class="font-medium">Fecha:</span>
                <span class="ml-1">{{ \Carbon\Carbon::parse($tramite->fecha_inicio)->format('d/m/Y') }}</span>
            </div>
        </div>
    </div>
@endforeach
                @else
                    <div class="p-8 text-center text-gray-500">
                        <flux:icon.folder-open variant="outline" class="w-12 h-12 mx-auto mb-4 text-gray-400" />
                        @if($fechaDesde || $fechaHasta)
                            <p class="text-lg font-medium mb-2">No hay trámites en este período</p>
                            <p class="text-sm">Intenta cambiar las fechas del filtro</p>
                        @else
                            <p class="text-lg font-medium mb-2">No hay trámites pendientes</p>
                            <p class="text-sm">Tu bandeja de entrada está vacía</p>
                        @endif
                    </div>
                @endif
            </div>
        </div>

        {{-- Columna derecha: Detalles del trámite --}}
        <div class="rounded-lg shadow bg-white">
            <div class="p-4 border-b flex items-center gap-2">
                <flux:icon.document-text class="w-5 h-5 text-blue-500" />
                <h2 class="text-lg font-semibold">Detalles del Trámite</h2>
            </div>
            
            @if($tramiteSeleccionado)
            @php
                $plazoDetalle = $this->obtenerEstadoPlazo($tramiteSeleccionado->fecha_inicio);
            @endphp
                <div class="p-6 space-y-6">
                    {{-- Información básica --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Código</label>
                            <div class="bg-gray-50 rounded-lg p-3 font-mono text-sm">
                                {{ $tramiteSeleccionado->codigo }}
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Estado</label>
                            <div class="flex">
                                @php
                                    $badgeVariant = match($tramiteSeleccionado->estado) {
                                        'Pendiente' => 'warning',
                                        'En Revisión' => 'info', 
                                        'Atendido' => 'primary',
                                        'Aprobado' => 'success',
                                        'Finalizado' => 'success',
                                        'Derivado' => 'zinc',
                                        default => 'zinc'
                                    };
                                @endphp
                                <flux:badge variant="{{ $badgeVariant }}">
                                    {{ $tramiteSeleccionado->estado }}
                                </flux:badge>
                            </div>
                        </div>
                    </div>
                    <div class="border-2 rounded-lg p-4 
            @if($plazoDetalle['color'] == 'green') border-green-200 bg-green-50 
            @elseif($plazoDetalle['color'] == 'yellow') border-yellow-200 bg-yellow-50
            @elseif($plazoDetalle['color'] == 'red') border-red-200 bg-red-50 
            @endif">
            
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-3">
                    @if($plazoDetalle['color'] == 'green')
                        <flux:icon.check-circle class="w-6 h-6 text-green-600" />
                    @elseif($plazoDetalle['color'] == 'yellow')
                        <flux:icon.clock class="w-6 h-6 text-yellow-600" />
                    @elseif($plazoDetalle['color'] == 'red')
                        <flux:icon.exclamation-triangle class="w-6 h-6 text-red-600" />
                    @endif
                    
                    <div>
                        <h3 class="font-semibold text-lg 
                            @if($plazoDetalle['color'] == 'green') text-green-800 
                            @elseif($plazoDetalle['color'] == 'yellow') text-yellow-800
                            @elseif($plazoDetalle['color'] == 'red') text-red-800 
                            @endif">
                            {{ $plazoDetalle['texto'] }}
                        </h3>
                        <p class="text-sm 
                            @if($plazoDetalle['color'] == 'green') text-green-600 
                            @elseif($plazoDetalle['color'] == 'yellow') text-yellow-600
                            @elseif($plazoDetalle['color'] == 'red') text-red-600 
                            @endif">
                
                        </p>
                    </div>
                </div>
                
                <flux:badge 
                    variant="{{ $plazoDetalle['color'] == 'green' ? 'success' : ($plazoDetalle['color'] == 'yellow' ? 'warning' : 'danger') }}" 
                    size="lg">
                </flux:badge>
            </div>
        </div>

        {{-- NUEVA SECCIÓN: Observaciones --}}
        <div class="border-t pt-6">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-sm font-medium text-gray-700 flex items-center">
                    <flux:icon.chat-bubble-left-ellipsis class="w-4 h-4 mr-2" />
                    Observaciones
                </h3>
                <flux:button 
                    variant="outline" 
                    size="xs" 
                    wire:click="$set('mostrarObservaciones', {{ !$mostrarObservaciones }})"
                    icon="{{ $mostrarObservaciones ? 'eye-slash' : 'pencil-square' }}">
                    {{ $mostrarObservaciones ? 'Cancelar' : 'Agregar Observación' }}
                </flux:button>
            </div>
            
            {{-- Mostrar observaciones existentes --}}
            @if($tramiteSeleccionado->observaciones)
                <div class="bg-gray-50 rounded-lg p-4 mb-4">
                    <p class="text-sm text-gray-700">{{ $tramiteSeleccionado->observaciones }}</p>
                </div>
            @endif
            
            {{-- Formulario para nuevas observaciones --}}
            @if($mostrarObservaciones)
                <div class="space-y-3">
                    <textarea 
                        wire:model="observaciones"
                        placeholder="Escribe tus observaciones aquí..."
                        class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 resize-none"
                        rows="4">
                    </textarea>
                    
                    <div class="flex gap-2">
                        <flux:button 
                            variant="primary" 
                            size="sm" 
                            wire:click="guardarObservaciones"
                            icon="check">
                            Guardar Observación
                        </flux:button>
                        <flux:button 
                            variant="outline" 
                            size="sm" 
                            wire:click="$set('mostrarObservaciones', false)"
                            icon="x-mark">
                            Cancelar
                        </flux:button>
                    </div>
                </div>
            @endif
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Documento</label>
                        <div class="bg-gray-50 rounded-lg p-3 text-sm">
                            {{ $tramiteSeleccionado->documento }}
                        </div>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Solicitante</label>
                        <div class="bg-gray-50 rounded-lg p-3 text-sm flex items-center">
                            <flux:icon.user class="w-4 h-4 mr-2 text-gray-500" />
                            {{ $tramiteSeleccionado->solicitante }}
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Fecha de Inicio</label>
                            <div class="bg-gray-50 rounded-lg p-3 text-sm flex items-center">
                                <flux:icon.calendar-days class="w-4 h-4 mr-2 text-gray-500" />
                                {{ \Carbon\Carbon::parse($tramiteSeleccionado->fecha_inicio)->format('d/m/Y') }}
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Fecha de Registro</label>
                            <div class="bg-gray-50 rounded-lg p-3 text-sm flex items-center">
                                <flux:icon.clock class="w-4 h-4 mr-2 text-gray-500" />
                                {{ $tramiteSeleccionado->created_at->format('d/m/Y H:i') }}
                            </div>
                        </div>
                    </div>
                    
                    {{-- Botones de acción --}}
                    <div class="border-t pt-6">
                        <h3 class="text-sm font-medium text-gray-700 mb-4 flex items-center">
                            <flux:icon.cog-6-tooth class="w-4 h-4 mr-2" />
                            Acciones Disponibles
                        </h3>
                        
                        @if($tramiteSeleccionado->estado === 'Pendiente')
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                                <!--<flux:button 
                                    variant="primary" 
                                    size="sm" 
                                    icon="hand-raised"
                                    wire:click="marcarAtendido({{ $tramiteSeleccionado->id }})" 
                                    wire:confirm="¿Marcar este trámite como atendido?"
                                    class="w-full">
                                    Marcar Atendido
                                </flux:button>-->

                                <flux:button 
                                    variant="outline" 
                                    size="sm" 
                                    icon="share"
                                    wire:click="derivar({{ $tramiteSeleccionado->id }})" 
                                    wire:confirm="¿Derivar este trámite?"
                                    class="w-full text-blue-600 border-blue-300 hover:bg-blue-50">
                                    Derivar
                                </flux:button>

                                <!--<flux:button 
                                    variant="outline" 
                                    size="sm" 
                                    icon="check"
                                    wire:click="aprobar({{ $tramiteSeleccionado->id }})" 
                                    wire:confirm="¿Aprobar este trámite?"
                                    class="w-full text-green-600 border-green-300 hover:bg-green-50">
                                    Aprobar Directamente
                                </flux:button>-->

                                <flux:button 
                                    variant="outline" 
                                    size="sm" 
                                    icon="check-badge"
                                    wire:click="finalizar({{ $tramiteSeleccionado->id }})" 
                                    wire:confirm="¿Finalizar este trámite?"
                                    class="w-full text-indigo-600 border-indigo-300 hover:bg-indigo-50">
                                    Tramite atendido
                                </flux:button>
                            </div>

                        @elseif($tramiteSeleccionado->estado === 'Atendido')
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                                <flux:button 
                                    variant="outline" 
                                    size="sm" 
                                    icon="check"
                                    wire:click="aprobar({{ $tramiteSeleccionado->id }})" 
                                    wire:confirm="¿Aprobar este trámite?"
                                    class="w-full text-green-600 border-green-300 hover:bg-green-50">
                                    Aprobar
                                </flux:button>
                                
                                <flux:button 
                                    variant="outline" 
                                    size="sm" 
                                    icon="share"
                                    wire:click="derivar({{ $tramiteSeleccionado->id }})" 
                                    wire:confirm="¿Derivar este trámite?"
                                    class="w-full text-blue-600 border-blue-300 hover:bg-blue-50">
                                    Derivar
                                </flux:button>
                            </div>

                        @elseif($tramiteSeleccionado->estado === 'Aprobado')
                            <flux:button 
                                variant="outline" 
                                size="sm" 
                                icon="check-badge"
                                wire:click="finalizar({{ $tramiteSeleccionado->id }})" 
                                wire:confirm="¿Finalizar este trámite?"
                                class="w-full text-indigo-600 border-indigo-300 hover:bg-indigo-50">
                                Finalizar Trámite
                            </flux:button>

                        @else
                            <div class="text-center py-4">
                                <flux:icon.check-circle class="w-8 h-8 mx-auto mb-2 text-green-500" />
                                <p class="text-gray-500 text-sm">Este trámite ya no requiere acciones</p>
                                <flux:badge variant="success" size="sm" class="mt-2">
                                    Estado: {{ $tramiteSeleccionado->estado }}
                                </flux:badge>
                            </div>
                        @endif
                    </div>
                </div>
            @else
                <div class="p-8 text-center text-gray-500">
                    <flux:icon.document-text variant="outline" class="w-12 h-12 mx-auto mb-4 text-gray-400" />
                    <p class="text-lg font-medium mb-2">Selecciona un trámite</p>
                    <p class="text-sm">Haz clic en un trámite de la bandeja de entrada para ver sus detalles</p>
                </div>
            @endif
        </div>
    </div>

</div>
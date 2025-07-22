<div class="p-4 space-y-6">
    {{-- Título --}}
    <h2 class="text-2xl font-bold mb-4">
        Derivar Trámite #{{ $tramite->id }}
    </h2>

    {{-- Recuadro con información del trámite --}}
    <div class="bg-gray-100 border border-gray-300 rounded p-4 space-y-2">
        <p><strong>Número de Trámite: </strong> {{ $tramite->id }}</p>
        <p><strong>Asunto: </strong> {{ $tramite->documento ?? 'N/D' }}</p>
        <p><strong>Remitente: </strong> {{ $tramite->solicitante ?? 'N/D' }}</p>
        <p><strong>Estado Actual: </strong> {{ $tramite->estado }}</p>
    </div>

    {{-- Recuadro para seleccionar destinatarios --}}
    <div class="bg-white border border-gray-300 rounded p-4">
        <label class="font-semibold block mb-2">Seleccionar destinatarios:</label>

        @if($usuariosFiltrados->isEmpty())
            <p class="text-gray-500 text-sm">No se encontraron funcionarios disponibles.</p>
        @else
            <div>
                @foreach($usuariosFiltrados as $index => $usuario)
                    <label class="flex items-center justify-between cursor-pointer py-2
                                  @if($index < $usuariosFiltrados->count() - 1) border-b border-gray-300 @endif
                                  ">
                        <div class="flex items-center space-x-4">
                            {{-- Checkbox con mayor espacio a la derecha --}}
                            <input type="checkbox" 
                                   wire:model="destinatariosIds" 
                                   value="{{ $usuario->id }}" 
                                   class="w-4 h-4"
                            >
                            <span class="select-none">
                                {{ $usuario->name }} {{ $usuario->last_name }} ({{ $usuario->email }})
                            </span>
                        </div>

                        {{-- Texto "Disponible" sin recuadro, alineado a derecha --}}
                        <span class="text-green-600 font-semibold text-sm">
                            Disponible
                        </span>
                    </label>
                @endforeach
            </div>
        @endif

        @error('destinatariosIds')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    {{-- Comentarios --}}
    <div class="bg-white border border-gray-300 rounded p-4">
        <label class="font-semibold block mb-2">Comentario (opcional):</label>
        <textarea wire:model="comentario" 
                  class="w-full border rounded px-3 py-2" 
                  rows="4"
                  placeholder="Escribe aquí algún comentario relevante..."></textarea>
        @error('comentario')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    {{-- Botones --}}
    <div class="flex space-x-3 mt-4">
        <button wire:click="derivarTramite" 
                class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded transition">
            Confirmar derivación
        </button>
        <a href="{{ route('panel.principal') }}" 
           class="bg-gray-300 hover:bg-gray-400 text-black px-5 py-2 rounded inline-block">
            Cancelar y volver
        </a>
    </div>

    {{-- Mensajes flash --}}
    @if (session()->has('success'))
        <p class="text-green-600 mt-4">{{ session('success') }}</p>
    @endif
    @if (session()->has('error'))
        <p class="text-red-600 mt-4">{{ session('error') }}</p>
    @endif
</div>
<div class="w-full max-w-[1000px] mx-auto p-6 bg-white rounded-md shadow-md">
    <!-- Título -->
    <div class="text-center mb-6">
        <h1 class="text-xl font-bold text-yellow-600 uppercase">
            {{ $titulo }}
        </h1>
    </div>

    <!-- Mostrar errores generales -->
    @if ($error)
        <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded">
            {{ $error }}
        </div>
    @endif

    <!-- Mostrar mensaje de éxito -->
    @if (session()->has('message'))
        <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded">
            {{ session('message') }}
        </div>
    @endif

    <!-- Grid con proporciones ajustadas -->
    <div class="flex flex-col lg:flex-row gap-6">
        <!-- Columna Izquierda: más estrecha -->
        <div class="w-full lg:w-1/3 bg-gray-50 p-4 border rounded-md">
            <h2 class="text-sm font-bold mb-2">Descripción :</h2>
            <p class="text-sm mb-2 font-semibold">{{ $descripcion }}</p>

            <h2 class="text-sm font-bold mb-2">REQUISITOS:</h2>
            <ol class="text-xs list-decimal list-inside space-y-1">
                @foreach ($requisitos as $index => $requisito)
                    <li>{{ $requisito }}</li>
                @endforeach
            </ol>
        </div>

        <!-- Columna Derecha: más amplia -->
        <div class="w-full lg:w-2/3 space-y-2">
            <!-- Detalles -->
            <div class="bg-gray-50 p-4 border rounded-md">
                <h2 class="text-sm font-bold mb-2">Detalles :</h2>
                <ul class="text-xs list-disc list-inside">
                    <li><strong>Duración:</strong> {{ $duracion ?? 'N/A' }}</li>
                    <li><strong>Área:</strong> {{ $area ?? 'N/A' }}</li>
                    <li><strong>Dependencia:</strong> {{ $dependencia ?? 'N/A' }}</li>
                </ul>
            </div>

            <!-- Sustento -->
            <div class="bg-gray-50 p-4 border rounded-md">
                <label class="block text-sm font-medium text-gray-700 mb-1">Sustento:</label>
                <input wire:model.defer="sustento" type="text"
                       class="w-full px-3 py-2 border rounded-md text-sm focus:outline-none focus:ring focus:border-blue-300">
                @error('sustento')
                    <span class="text-xs text-red-600">{{ $message }}</span>
                @enderror
            </div>

            <!-- Tabla de requisitos con archivos -->
            <div class="bg-gray-50 p-4 border rounded-md overflow-x-auto">
                <table class="w-full text-xs">
                    <thead class="bg-gray-200 text-gray-700">
                        <tr>
                            <th class="p-2 text-left">Requisito</th>
                            <th class="p-2 text-left">Archivo (máx. 4MB)</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($requisitos as $index => $requisito)
                            <tr class="border-b border-gray-200">
                                <td class="p-2 align-top">{{ $requisito }}</td>
                                <td class="p-2">
                                    <input wire:model="archivos.{{ $index }}" type="file"
                                           class="text-xs border rounded-md p-1 w-full">
                                    @error("archivos.$index")
                                        <span class="text-xs text-red-600">{{ $message }}</span>
                                    @enderror
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Botón de enviar -->
            <div class="flex justify-center pt-4">
                <button wire:click="enviarSolicitud"
                        class="px-6 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 transition">
                    + ENVIAR SOLICITUD
                </button>
            </div>
        </div>
    </div>

    <!-- Botón de regreso -->
    <div class="mt-6 flex justify-center">
        <button wire:click="volver"
                class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-100 transition">
            ← VOLVER
        </button>
    </div>
</div>

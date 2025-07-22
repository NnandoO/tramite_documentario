<div class="w-full max-w-3xl mx-auto p-6 bg-white rounded-md shadow">
    <h1 class="text-xl font-bold text-yellow-600 text-center mb-4">{{ $tramiteName }}</h1>

    @if($detalles)
        <div class="mb-4 text-sm">
            <p><strong>Duración:</strong> {{ $detalles->duracion }} días</p>
            <p><strong>Área de inicio:</strong> {{ $detalles->area_inicio }}</p>
            <p><strong>Dependencia:</strong> Sin asignar</p>
        </div>
    @endif

    <div class="mb-4">
        <h2 class="font-bold mb-2 text-sm">Requisitos:</h2>
        <ol class="list-decimal list-inside text-xs space-y-1">
            @foreach($requisitos as $req)
                <li>{{ $req }}</li>
            @endforeach
        </ol>
    </div>

    <div class="mb-4">
        <label class="block text-sm font-medium mb-1">Sustento</label>
        <textarea wire:model.defer="sustento" class="w-full border rounded p-2 text-sm"></textarea>
        @error('sustento')<span class="text-red-600 text-xs">{{ $message }}</span>@enderror
    </div>

    <div class="mb-4">
        <h2 class="font-bold text-sm mb-2">Archivos</h2>
        @foreach($requisitos as $index => $req)
            <div class="mb-2">
                <flux:input type="file" wire:model="logo" label="{{ $req }}"/>
                @error("archivos.$index")<span class="text-red-600 text-xs">{{ $message }}</span>@enderror
            </div>
        @endforeach
    </div>

    <div class="text-center">
        <button wire:click="enviarSolicitud" class="px-4 py-2 bg-green-600 text-white rounded">Enviar solicitud</button>
        <button wire:click="volver" class="ml-2 px-4 py-2 bg-gray-200 text-gray-700 rounded">Volver</button>
    </div>

    @if (session()->has('message'))
        <div class="mt-4 p-2 bg-green-100 text-green-700 rounded text-sm">{{ session('message') }}</div>
    @endif
</div>

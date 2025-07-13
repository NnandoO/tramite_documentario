<div>
    <div class="mb-4">
        <div class="flex">
            <input type="text" wire:model.debounce.300ms="search" placeholder="Búsqueda por palabras clave" class="flex-1 border rounded-l px-3 py-2 focus:ring focus:border-green-300">
            <button class="bg-green-600 hover:bg-green-700 text-white p-2 rounded-r">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35M10 18a8 8 0 100-16 8 8 0 000 16z"></path></svg>
            </button>
        </div>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-6 gap-4 mb-4">
        <select wire:model.debounce.300ms="year" class="border rounded px-3 py-2 focus:ring focus:border-green-300">
            <option value="">Año</option>
            @foreach($years as $y)
                <option value="{{ $y }}">{{ $y }}</option>
            @endforeach
        </select>
        <select wire:model.debounce.300ms="month" class="border rounded px-3 py-2 focus:ring focus:border-green-300">
            <option value="">Mes</option>
            @foreach($months as $num => $name)
                <option value="{{ $num }}">{{ $name }}</option>
            @endforeach
        </select>
        <select wire:model.debounce.300ms="faculty" class="border rounded px-3 py-2 focus:ring focus:border-green-300">
            <option value="">Facultad</option>
            @foreach($facultades as $f)
                <option value="{{ $f }}">{{ $f }}</option>
            @endforeach
        </select>
        <select wire:model.debounce.300ms="type" class="border rounded px-3 py-2 focus:ring focus:border-green-300">
            <option value="">Tipo de trámite</option>
            @foreach($tiposTramite as $t)
                <option value="{{ $t }}">{{ $t }}</option>
            @endforeach
        </select>
        <select wire:model.debounce.300ms="state" class="border rounded px-3 py-2 focus:ring focus:border-green-300">
            <option value="">Estado</option>
            @foreach($states as $key => $label)
                <option value="{{ $key }}">{{ $label }}</option>
            @endforeach
        </select>
        <button type="button" wire:click="resetFilters" class="bg-green-500 hover:bg-green-600 text-white font-medium px-4 py-2 rounded">
            Limpiar filtros
        </button>
    </div>

    <div class="overflow-x-auto bg-white rounded-lg">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-white text-left font-medium">
                <tr>
                    <th class="p-2 text-sm">Código</th>
                    <th class="p-2 text-sm">Trámite</th>
                    <th class="p-2 text-sm">Fecha</th>
                    <th class="p-2 text-sm">Facultad</th>
                    <th class="p-2 text-sm">Estado</th>
                    <th class="p-2 text-sm">Acciones</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($expedientes as $expediente)
                <tr class="hover:bg-gray-50">
                    <td class="p-2 text-sm">{{ $expediente->codigo }}</td>
                    <td class="p-2 text-sm">{{ $expediente->nombre }}</td>
                    <td class="p-2 text-sm">{{ $expediente->fecha_expediente->format('Y-m-d') }}</td>
                    <td class="p-2 text-sm">{{ $expediente->facultad->nombre }}</td>
                    <td class="p-2 text-sm">{{ $expediente->documentos->isNotEmpty() ? 'Finalizado' : 'Pendiente' }}</td>
                    <td class="p-2 text-sm">
                        <a href="{{ route('expedientes.show', $expediente) }}">
                            <svg class="text-green-600 hover:text-green-800 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="col-span-full text-center py-8 text-gray-500">SIN RESULTADOS</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

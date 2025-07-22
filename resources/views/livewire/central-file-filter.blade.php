
<div>
    <div class="pb-4">
        <h1 class="text-3xl font-bold text-green-800">Archivo Central</h1>
    </div>



    <div class="max-w-6xl mx-auto bg-white shadow-md rounded-xl mt-3 p-4 space-y-6">
        <div class="flex flex-wrap gap-4 mt-4">
            <flux:select wire:model.defer="year" placeholder="Año" label="Año">
                <flux:select.option value="">Todos</flux:select.option>
                @foreach($years as $y)
                    <flux:select.option value="{{ $y }}">{{ $y }}</flux:select.option>
                @endforeach
            </flux:select>

            <flux:select wire:model.defer="month_id" placeholder="Mes" label="Mes">
                <flux:select.option value="">Todos</flux:select.option>
                @foreach($months as $month)
                    <flux:select.option value="{{ $month->id }}">{{ $month->name }}</flux:select.option>
                @endforeach
            </flux:select>

            <flux:input wire:model.defer="dni" icon="identification" placeholder="DNI" label="DNI" />

        <flux:select wire:model.defer="faculty_id" placeholder="Facultad" label="Facultad">
    <flux:select.option value="">Todas las facultades</flux:select.option>
    @foreach($facultades as $facultad)
        <flux:select.option value="{{ $facultad->id }}">{{ $facultad->nombre }}</flux:select.option>
    @endforeach
</flux:select>

    <flux:select wire:model.defer="tramite_type_id" placeholder="Tipo de trámite" label="Tipo de trámite">
        <flux:select.option value="">Todos</flux:select.option>
        @foreach($tramiteTypes as $type)
            <flux:select.option value="{{ $type->id }}">{{ $type->name }}</flux:select.option>
        @endforeach
    </flux:select>


    <div class="flex justify-end gap-2">
        <flux:button wire:click="applyFilters" variant="primary" color="green">
            Aplicar filtros
        </flux:button>
        <flux:button wire:click="limpiarFiltros" variant="primary" color="yellow">
            Limpiar filtros
        </flux:button>
    </div>
</div>
   
    <table class="w-full text-sm text-left text-gray-700 mt-6">
    <thead class="text-xs text-gray-600 uppercase border-b">
        <tr>
            <th class="px-4 py-2">Código</th>
            <th class="px-4 py-2">DNI</th>
            <th class="px-4 py-2">Solicitante</th>
            <th class="px-4 py-2">Tipo</th>
            <th class="px-4 py-2">Facultad</th>
            <th class="px-4 py-2">Fecha</th>
            <th class="px-4 py-2">Estado</th>
            <th class="px-4 py-2">Acciones</th>
        </tr>
    </thead>
    <tbody>
        @forelse($files as $file)
        <tr class="border-b">
            <td class="px-4 py-2">{{ $file->id }}</td>
            <td class="px-4 py-2">{{ $file->dni }}</td>
            <td class="px-4 py-2">{{ $file->solicitante }}</td>
            <td class="px-4 py-2">{{ $file->tramiteType->name ?? '-' }}</td>
            <td class="px-4 py-2">{{ $file->facultad->nombre ?? '-' }}</td>
            <td class="px-4 py-2">{{ $file->created_at->format('d/m/Y h:i a') }}</td>
            <td class="px-4 py-2">
                <span class="bg-green-100 text-green-800 text-xs font-semibold px-2.5 py-0.5 rounded">
                    {{ $file->status->name ?? '-' }}
                </span>
            </td>
            <td class="px-4 py-2">
                <flux:button wire:click="viewFile({{ $file->id }})" variant="primary" color="green">
                    Ver Detalles
                </flux:button>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="7" class="px-4 py-6 text-center text-gray-500">No se encontraron resultados</td>
        </tr>
        @endforelse
    </tbody>
</table>

    <div class="mt-4">
        {{ $files->links() }}
    </div>


</div>
</div>


<div>
    <div class="pb-4">
        <h1 class="text-3xl font-bold text-green-800">Archivo Central</h1>
    </div>

    <div class="max-w-6xl mx-auto bg-white shadow-md rounded-xl mt-5 p-4 space-y-6">
        <flux:input icon="magnifying-glass" placeholder="Filtrar por palabras clave" label="Filtros"/>
    </div>

    <div class="max-w-6xl mx-auto bg-white shadow-md rounded-xl mt-3 p-4 space-y-6">
        <div class="flex flex-wrap gap-4 mt-4">
            <flux:select wire:model.debounce.500ms="year" placeholder="Año" label="Año">
                <flux:select.option>2021</flux:select.option>
                <flux:select.option>2022</flux:select.option>
                <flux:select.option>2023</flux:select.option>
                <flux:select.option>2024</flux:select.option>
                <flux:select.option>2025</flux:select.option>
            </flux:select>

            <flux:select wire:model.debounce.500ms="month" placeholder="Mes" label="Mes">
                <flux:select.option>Enero</flux:select.option>
                <flux:select.option>Febrero</flux:select.option>
                <flux:select.option>Marzo</flux:select.option>
                <flux:select.option>Abril</flux:select.option>
                <flux:select.option>Mayo</flux:select.option>
                <flux:select.option>Junio</flux:select.option>
                <flux:select.option>Julio</flux:select.option>
                <flux:select.option>Agosto</flux:select.option>
                <flux:select.option>Septiembre</flux:select.option>
                <flux:select.option>Octubre</flux:select.option>
                <flux:select.option>Noviembre</flux:select.option>
                <flux:select.option>Diciembre</flux:select.option>
            </flux:select>

        <flux:select wire:model.debounce.500ms="faculty_id" placeholder="Facultad" label="Facultad">
    <flux:select.option value="">Todas las facultades</flux:select.option>
    @foreach($facultades as $facultad)
        <flux:select.option value="{{ $facultad->id }}">{{ $facultad->nombre }}</flux:select.option>
    @endforeach
</flux:select>

    <flux:select wire:model.debounce.500ms="document_type" placeholder="Tipo de documento" label="Tipo de documento">
        <flux:select.option>Solicitud</flux:select.option>
        <flux:select.option>Constancia</flux:select.option>
        <flux:select.option>Certificado</flux:select.option>
        <flux:select.option>Resolución</flux:select.option>
        <flux:select.option>Informe</flux:select.option>
        <flux:select.option>Memorando</flux:select.option>
        <flux:select.option>Oficio</flux:select.option>
    </flux:select>

    <flux:select wire:model.debounce.500ms="status" placeholder="Estado" label="Estado">
        <flux:select.option>Pendiente</flux:select.option>
        <flux:select.option>En Proceso</flux:select.option>
        <flux:select.option>Finalizado</flux:select.option>
    </flux:select>

    <div class="flex justify-end">
        <flux:button wire:click="limpiarFiltros" variant="primary" color="yellow">
            Limpiar filtros
        </flux:button>
    </div>
</div>
   
    <table class="w-full text-sm text-left text-gray-700 mt-6">
    <thead class="text-xs text-gray-600 uppercase border-b">
        <tr>
            <th class="px-4 py-2">Código</th>
            <th class="px-4 py-2">Solicitante</th>
            <th class="px-4 py-2">Tipo</th>
            <th class="px-4 py-2">Facultad</th>
            <th class="px-4 py-2">Fecha</th>
            <th class="px-4 py-2">Estado</th>
            <th class="px-4 py-2">Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach($files as $file)
        <tr class="border-b">
            <td class="px-4 py-2">{{ $file->id }}</td>
            <td class="px-4 py-2">{{ $file->name }}</td>
            <td class="px-4 py-2">{{ $file->document_type }}</td>
            <td class="px-4 py-2">{{ $file->facultad->nombre ?? '-' }}</td>
            <td class="px-4 py-2">{{ $file->created_at->format('d/m/Y h:i a') }}</td>
            <td class="px-4 py-2">
                <span class="bg-green-100 text-green-800 text-xs font-semibold px-2.5 py-0.5 rounded">
                    {{ $file->status }}
                </span>
            </td>
            <td class="px-4 py-2">
                <flux:button wire:click="viewFile({{ $file->id }})" variant="primary" color="green">
                    Ver Detalles
                </flux:button>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>


</div>
</div>
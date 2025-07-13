<div>
    <div class="grid grid-cols-1 sm:grid-cols-5 gap-4 mb-4">
        <select wire:model="year" class="border rounded px-3 py-2 focus:ring focus:border-indigo-300" aria-label="Año" data-testid="year-filter">
            <option value="">{{ __('Año') }}</option>
            @foreach($this->years as $yearOption)
                <option value="{{ $yearOption }}">{{ $yearOption }}</option>
            @endforeach
        </select>
        <select wire:model="month" class="border rounded px-3 py-2 focus:ring focus:border-indigo-300" aria-label="Mes" data-testid="month-filter">
            <option value="">{{ __('Mes') }}</option>
            @foreach($this->months as $num => $name)
                <option value="{{ $num }}">{{ $name }}</option>
            @endforeach
        </select>
        <select wire:model="faculty" class="border rounded px-3 py-2 focus:ring focus:border-indigo-300" aria-label="Facultad" data-testid="faculty-filter">
            <option value="">{{ __('Facultad') }}</option>
            @foreach($this->faculties as $id => $name)
                <option value="{{ $id }}">{{ $name }}</option>
            @endforeach
        </select>
        <select wire:model="type" class="border rounded px-3 py-2 focus:ring focus:border-indigo-300" aria-label="Tipo" data-testid="type-filter">
            <option value="">{{ __('Tipo de Trámite') }}</option>
            @foreach($this->types as $id => $name)
                <option value="{{ $id }}">{{ $name }}</option>
            @endforeach
        </select>
        <select wire:model="state" class="border rounded px-3 py-2 focus:ring focus:border-indigo-300" aria-label="Estado" data-testid="state-filter">
            <option value="">{{ __('Estado') }}</option>
            @foreach($this->states as $key => $label)
                <option value="{{ $key }}">{{ $label }}</option>
            @endforeach
        </select>
    </div>
    <div class="mb-4">
        <button type="button" wire:click="resetFilters" class="bg-gray-200 hover:bg-gray-300 text-sm font-medium rounded p-2" data-testid="clear-filters">
            {{ __('Limpiar filtros') }}
        </button>
    </div>
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="text-left">
                <tr>
                    <th class="p-2 text-sm">{{ __('Nombre del expediente') }}</th>
                    <th class="p-2 text-sm">{{ __('Fecha') }}</th>
                    <th class="p-2 text-sm">{{ __('Facultad') }}</th>
                    <th class="p-2 text-sm">{{ __('Tipo de Trámite') }}</th>
                    <th class="p-2 text-sm">{{ __('Estado') }}</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($expedientes as $expediente)
                    <tr class="hover:bg-gray-50">
                        <td class="p-2 text-sm">{{ $expediente->nombre }}</td>
                        <td class="p-2 text-sm">{{ $expediente->fecha_expediente->format('Y-m-d') }}</td>
                        <td class="p-2 text-sm">{{ $expediente->facultad->nombre }}</td>
                        <td class="p-2 text-sm">{{ $expediente->tramite->nombre }}</td>
                        <td class="p-2 text-sm">
                            {{ $expediente->documentos->isNotEmpty() ? __('Con Documentos') : __('Sin Documentos') }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="p-4 text-center">{{ __('SIN RESULTADOS') }}</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<x-layouts.app :title="__('Expedientes')">
    <div class="container mx-auto grid max-w-3xl gap-6 p-6">
        <h1 class="text-2xl font-bold">{{ __('Expedientes') }}</h1>
        <form method="GET" class="grid gap-4 md:grid-cols-3">
            <x-form.field label="Tipo de trámite" name="tipo_tramite" :errors="null">
                <select id="tipo_tramite" name="tipo_tramite" class="w-full rounded border-gray-300 text-sm shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    <option value="">{{ __('Todos') }}</option>
                    @foreach($tramites as $tramite)
                        <option value="{{ $tramite->id }}" @selected(request('tipo_tramite') == $tramite->id)>{{ $tramite->nombre }}</option>
                    @endforeach
                </select>
            </x-form.field>
            <x-form.field label="Facultad" name="facultad" :errors="null">
                <select id="facultad" name="facultad" class="w-full rounded border-gray-300 text-sm shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    <option value="">{{ __('Todas') }}</option>
                    @foreach($facultades as $facultad)
                        <option value="{{ $facultad->id }}" @selected(request('facultad') == $facultad->id)>{{ $facultad->nombre }}</option>
                    @endforeach
                </select>
            </x-form.field>
            <div class="grid grid-cols-2 gap-2">
                <x-form.field label="Desde" name="desde" :errors="null">
                    <input id="desde" type="date" name="desde" value="{{ request('desde') }}" class="w-full rounded border-gray-300 text-sm shadow-sm focus:border-blue-500 focus:ring-blue-500" />
                </x-form.field>
                <x-form.field label="Hasta" name="hasta" :errors="null">
                    <input id="hasta" type="date" name="hasta" value="{{ request('hasta') }}" class="w-full rounded border-gray-300 text-sm shadow-sm focus:border-blue-500 focus:ring-blue-500" />
                </x-form.field>
            </div>
            <div class="flex items-end">
                <button class="rounded bg-blue-600 px-4 py-2 text-sm font-semibold text-white hover:bg-blue-700">{{ __('Filtrar') }}</button>
            </div>
        </form>

        <div class="overflow-x-auto">
            <table class="min-w-full text-sm">
                <thead class="text-left font-medium text-gray-700 dark:text-gray-200">
                    <tr>
                        <th class="p-2">{{ __('Nombre') }}</th>
                        <th class="p-2">{{ __('Tipo trámite') }}</th>
                        <th class="p-2">{{ __('Facultad') }}</th>
                        <th class="p-2">{{ __('Fecha') }}</th>
                        <th class="p-2"></th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                    @foreach($expedientes as $expediente)
                        <tr>
                            <td class="p-2">{{ $expediente->nombre }}</td>
                            <td class="p-2">{{ $expediente->tramite->nombre }}</td>
                            <td class="p-2">{{ $expediente->facultad->nombre }}</td>
                            <td class="p-2">{{ $expediente->fecha_expediente->format('Y-m-d') }}</td>
                            <td class="p-2 text-right">
                                <a href="{{ route('expedientes.show', $expediente) }}" class="text-blue-600 hover:underline">{{ __('Ver') }}</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-layouts.app>

<x-layouts.app :title="__('Auditor\xC3\xADa de Entregas')">
    <div class="container mx-auto p-6">
        <h1 class="text-xl font-semibold mb-4">{{ __('Auditor\xC3\xADa de Entregas') }}</h1>
        <form method="GET" class="grid grid-cols-4 gap-4 mb-4">
            <input type="date" name="from" value="{{ request('from') }}" class="border p-2 rounded" />
            <input type="date" name="to" value="{{ request('to') }}" class="border p-2 rounded" />
            <input type="text" name="expediente" placeholder="{{ __('Expediente') }}" value="{{ request('expediente') }}" class="border p-2 rounded" />
            <input type="text" name="solicitante" placeholder="{{ __('Solicitante') }}" value="{{ request('solicitante') }}" class="border p-2 rounded" />
            <input type="text" name="operador" placeholder="{{ __('Operador') }}" value="{{ request('operador') }}" class="border p-2 rounded" />
            <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded">{{ __('Filtrar') }}</button>
        </form>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 text-sm">
                <thead>
                <tr>
                    <th class="p-2">{{ __('Fecha') }}</th>
                    <th class="p-2">{{ __('Expediente') }}</th>
                    <th class="p-2">{{ __('Solicitante') }}</th>
                    <th class="p-2">{{ __('Operador') }}</th>
                </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                @forelse($audits as $audit)
                    <tr>
                        <td class="p-2">{{ $audit->delivered_at->format('Y-m-d H:i') }}</td>
                        <td class="p-2">{{ $audit->expediente->codigo }}</td>
                        <td class="p-2">{{ $audit->solicitante->name ?? '' }}</td>
                        <td class="p-2">{{ $audit->operador->name }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="p-4 text-center">{{ __('SIN RESULTADOS') }}</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
        {{ $audits->withQueryString()->links() }}
    </div>
</x-layouts.app>

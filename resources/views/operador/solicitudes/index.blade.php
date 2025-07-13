@extends('operator.dashboard')

@section('module')
    <div class="container mx-auto p-4">
        <h1 class="text-xl font-semibold mb-4">{{ __('Solicitudes Pendientes') }}</h1>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="text-left">
                    <tr>
                        <th class="p-2 text-sm">{{ __('Nombre del solicitante') }}</th>
                        <th class="p-2 text-sm">{{ __('Código de expediente') }}</th>
                        <th class="p-2 text-sm">{{ __('Fecha de solicitud') }}</th>
                        <th class="p-2 text-sm">{{ __('Estado') }}</th>
                        <th class="p-2 text-sm">{{ __('Acciones') }}</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($solicitudes as $solicitud)
                        <tr class="hover:bg-gray-50">
                            <td class="p-2 text-sm">{{ $solicitud->nombre_solicitante }}</td>
                            <td class="p-2 text-sm">{{ $solicitud->codigo_expediente }}</td>
                            <td class="p-2 text-sm">{{ $solicitud->fecha->format('Y-m-d') }}</td>
                            <td class="p-2 text-sm">{{ $solicitud->status }}</td>
                            <td class="p-2 text-sm space-x-2">
                                <a href="{{ route('operador.solicitudes.show', $solicitud) }}" class="text-blue-600 px-2 py-1 rounded hover:bg-gray-100">
                                    {{ __('Ver') }}
                                </a>
                                <a href="{{ route('operador.solicitudes.evaluate', $solicitud) }}" class="text-yellow-500 px-2 py-1 rounded hover:bg-gray-100">
                                    {{ __('Evaluar') }}
                                </a>
                                <a href="#" class="text-green-600 px-2 py-1 rounded hover:bg-gray-100">
                                    {{ __('Descargar') }}
                                </a>
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
@endsection

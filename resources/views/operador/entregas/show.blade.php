@extends('operator.dashboard')

@section('module')
    <div class="container mx-auto p-4">
        <h1 class="text-xl font-semibold mb-4">{{ __('Notificación') }}</h1>
        <div class="bg-white shadow p-4 rounded mb-6">
            <p>{{ __('Solicitante: :name', ['name' => $entrega->solicitud->nombre_solicitante]) }}</p>
            <p>{{ __('Expediente: :code', ['code' => $entrega->solicitud->codigo_expediente]) }}</p>
            <p>{{ __('Fecha de aprobación: :date', ['date' => $entrega->created_at->format('Y-m-d')]) }}</p>
            <a href="{{ Storage::url($entrega->ruta) }}" class="text-blue-600 underline" target="_blank">{{ __('Ver archivo') }}</a>
        </div>
        <form method="POST" action="{{ route('operador.notificacion.store', $entrega) }}">
            @csrf
            <input type="hidden" name="expediente_entregado_id" value="{{ $entrega->id }}">
            <input type="hidden" name="solicitud_id" value="{{ $entrega->solicitud->id }}">
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded">{{ __('Generar solicitud de notificación') }}</button>
        </form>
        <div class="mt-6">
            <h2 class="font-semibold mb-2">{{ __('Historial de notificaciones') }}</h2>
            <div class="overflow-x-auto bg-white rounded-lg">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-white text-left font-medium">
                        <tr>
                            <th class="p-2 text-sm">{{ __('Fecha') }}</th>
                            <th class="p-2 text-sm">{{ __('Operador') }}</th>
                            <th class="p-2 text-sm">{{ __('Acción') }}</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach($entrega->notificaciones as $noti)
                            @foreach($noti->historial as $h)
                            <tr class="hover:bg-gray-50">
                                <td class="p-2 text-sm">{{ $h->created_at->format('Y-m-d H:i') }}</td>
                                <td class="p-2 text-sm">{{ $h->operador->name }}</td>
                                <td class="p-2 text-sm">{{ $h->accion }}</td>
                            </tr>
                            @endforeach
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection


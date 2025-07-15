<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-bold" style="color: #22572D;">Detalles del Trámite</h2>
                    <a href="{{ route('tramites.index') }}"
                       class="px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                        Volver
                    </a>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Información General</h3>
                        <dl class="grid grid-cols-1 gap-4">
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Número de Expediente</dt>
                                <dd class="mt-1 text-sm text-gray-900">{{ $tramite->expediente }}</dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Tipo de Trámite</dt>
                                <dd class="mt-1 text-sm text-gray-900">{{ $tramite->tipo_tramite }}</dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Estado Actual</dt>
                                <dd class="mt-1">
                                    <span class="px-2 py-1 text-sm rounded-full
                                        @if($tramite->estado == 'Aprobado') bg-green-100 text-green-800
                                        @elseif($tramite->estado == 'Rechazado') bg-red-100 text-red-800
                                        @elseif($tramite->estado == 'En Proceso') bg-blue-100 text-blue-800
                                        @else bg-gray-100 text-gray-800
                                        @endif">
                                        {{ $tramite->estado }}
                                    </span>
                                </dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Fecha de Envío</dt>
                                <dd class="mt-1 text-sm text-gray-900">{{ $tramite->fecha_envio->format('d/m/Y H:i') }}</dd>
                            </div>
                        </dl>
                    </div>

                    <div>
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Historial de Cambios</h3>
                        <div class="space-y-4">
                            @foreach($tramite->historial ?? [] as $cambio)
                                <div class="border-l-4 border-green-400 pl-4">
                                    <p class="text-sm text-gray-600">{{ $cambio['fecha'] }}</p>
                                    <p class="text-sm font-medium text-gray-900">{{ $cambio['usuario'] }}</p>
                                    <p class="text-sm text-gray-700">{{ $cambio['cambios'] }}</p>
                                    <p class="text-sm text-gray-600">Estado anterior: {{ $cambio['estado_anterior'] }}</p>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

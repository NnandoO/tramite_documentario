@php
    $tramites = [
        [
            'expediente'      => '2023-001',
            'tipo_tramite'    => 'Otorgamiento de Título',
            'estado'          => 'En Proceso',
            'fecha_envio'     => '2023-07-20',
            'actualizado'     => '2023-07-21',
            'funcionario'     => ['nombre' => 'Juan Pérez','cargo' => 'Secretario Académico'],
            'puede_editar'    => true,
        ],
        // …otros trámites
    ];
@endphp

<div class="p-6 bg-[#E0E0E0] min-h-screen">
    <div class="max-w-7xl mx-auto">
        <!-- Encabezado -->
        <div class="flex items-center justify-between mb-6">
            <div>
                <h1 class="text-2xl font-semibold mb-1">Mis Trámites</h1>
                <p class="text-gray-600">Gestiona y da seguimiento a tus trámites</p>
            </div>
            <div class="flex items-center gap-4">
                <button class="text-gray-600">
                    <span>Cerrar Sesión</span>
                </button>
                <span class="text-gray-600">{{ auth()->user()->name }}</span>
            </div>
        </div>

        <!-- Barra de búsqueda y filtro -->
        <div class="bg-white rounded-lg p-4 mb-6 flex justify-between items-center">
            <div class="relative flex-1 max-w-xl">
                <input 
                    type="text" 
                    id="search"
                    name="search"
                    placeholder="Buscar por tipo de trámite o número de expediente..."
                    class="w-full pl-10 pr-4 py-2 border rounded-lg"
                >
                <div class="absolute left-3 top-2.5 text-gray-400">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>
            </div>
            <select name="estado" id="estado" class="ml-4 border rounded-lg px-4 py-2">
                <option>Todos los estados</option>
                <option>En Proceso</option>
                <option>Aprobado</option>
                <option>Pendiente de Revisión</option>
                <option>Rechazado</option>
            </select>
        </div>

        <!-- Tabla de trámites -->
        <div class="bg-white rounded-lg overflow-hidden">
            <table class="min-w-full divide-y divide-gray-200">
                <thead>
                    <tr class="bg-gray-50">
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Expediente</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tipo de Trámite</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Estado</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Fecha Envío</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Funcionario</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Acciones</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($tramites as $tramite)
                    <tr>
                        <td class="px-6 py-4">
                            <div class="flex flex-col">
                                <span class="font-medium">{{ $tramite['expediente'] }}</span>
                                <span class="text-sm text-gray-500">Actualizado: {{ $tramite['actualizado'] }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4">{{ $tramite['tipo_tramite'] }}</td>
                        <td class="px-6 py-4">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full">
                                {{ $tramite['estado'] === 'En Proceso' ? 'bg-blue-100 text-blue-800' : '' }}
                                {{ $tramite['estado'] === 'Aprobado' ? 'bg-green-100 text-green-800' : '' }}
                                {{ $tramite['estado'] === 'Pendiente de Revisión' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                {{ $tramite['estado'] === 'Rechazado' ? 'bg-red-100 text-red-800' : '' }}">
                                {{ $tramite['estado'] }}
                            </span>
                        </td>
                        <td class="px-6 py-4">{{ $tramite['fecha_envio'] }}</td>
                        <td class="px-6 py-4">
                            <div class="flex flex-col">
                                <span class="font-medium">{{ $tramite['funcionario']['nombre'] }}</span>
                                <span class="text-sm text-gray-500">{{ $tramite['funcionario']['cargo'] }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center space-x-3">
                                <a 
                                    href="/detalle/{{ $tramite['expediente'] }}"
                                    class="text-gray-400 hover:text-gray-600"
                                    title="Ver detalles"
                                >
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                </a>
                                @if($tramite['puede_editar'])
                                <button 
                                    wire:click="editarTramite('{{ $tramite['expediente'] }}')"
                                    class="text-gray-400 hover:text-gray-600"
                                    title="Editar trámite"
                                >
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                </button>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<x-layouts.main>
    <div class="space-y-6">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="text-2xl font-bold text-[#22572D]">Mis Trámites</h2>
                <p class="text-gray-600">Gestiona y da seguimiento a tus trámites</p>
            </div>
        </div>

        <div class="flex justify-between items-center space-x-4">
            <div class="flex-1">
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center">
                        <i class="fas fa-search text-gray-400"></i>
                    </span>
                    <input type="text"
                           placeholder="Buscar por tipo de trámite o número de expediente..."
                           class="w-full pl-10 pr-4 py-2 border rounded-lg border-gray-300 focus:border-[#22572D] focus:ring focus:ring-[#22572D] focus:ring-opacity-50">
                </div>
            </div>
            <select class="border rounded-lg px-4 py-2 border-gray-300 focus:border-[#22572D] focus:ring focus:ring-[#22572D] focus:ring-opacity-50">
                <option value="">Todos los estados</option>
                <option value="En Proceso">En Proceso</option>
                <option value="Pendiente de Revisión">Pendiente de Revisión</option>
                <option value="Aprobado">Aprobado</option>
                <option value="Rechazado">Rechazado</option>
            </select>
        </div>

        <div class="bg-white rounded-lg shadow">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead>
                        <tr class="bg-[#22572D] text-white">
                            <th class="px-6 py-4 text-left text-sm font-medium">EXPEDIENTE</th>
                            <th class="px-6 py-4 text-left text-sm font-medium">TIPO DE TRÁMITE</th>
                            <th class="px-6 py-4 text-left text-sm font-medium">ESTADO</th>
                            <th class="px-6 py-4 text-left text-sm font-medium">FECHA ENVÍO</th>
                            <th class="px-6 py-4 text-left text-sm font-medium">FUNCIONARIO</th>
                            <th class="px-6 py-4 text-left text-sm font-medium">ACCIONES</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($tramites as $tramite)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4">
                                    <div class="flex flex-col">
                                        <span class="font-medium">{{ $tramite->expediente }}</span>
                                        <span class="text-sm text-gray-500">Actualizado: {{ $tramite->updated_at->format('d/m/Y') }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4">{{ $tramite->tipo_tramite }}</td>
                                <td class="px-6 py-4">
                                    @php
                                        $estadoClases = [
                                            'En Proceso' => 'bg-blue-100 text-blue-800',
                                            'Pendiente de Revisión' => 'bg-yellow-100 text-yellow-800',
                                            'Aprobado' => 'bg-green-100 text-green-800',
                                            'Rechazado' => 'bg-red-100 text-red-800',
                                            'Borrador' => 'bg-gray-100 text-gray-800'
                                        ];
                                        $clases = $estadoClases[$tramite->estado] ?? 'bg-gray-100 text-gray-800';
                                    @endphp
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium {{ $clases }}">
                                        @if($tramite->estado == 'En Proceso')
                                            <svg class="w-4 h-4 mr-1.5" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M10 3a7 7 0 100 14 7 7 0 000-14zm0 12a5 5 0 110-10 5 5 0 010 10zm0-8a3 3 0 100 6 3 3 0 000-6z"/>
                                            </svg>
                                        @endif
                                        {{ $tramite->estado }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-sm">{{ $tramite->fecha_envio->format('d/m/Y') }}</td>
                                <td class="px-6 py-4">
                                    <div class="flex flex-col">
                                        <span class="font-medium">{{ $tramite->funcionario }}</span>
                                        <span class="text-sm text-gray-500">{{ $tramite->cargo_funcionario }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex space-x-3">
                                        <a href="{{ route('tramites.show', $tramite) }}"
                                           class="text-[#22572D] hover:text-[#1a4423]">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        @if(in_array($tramite->estado, ['Enviado', 'Pendiente de Revisión']))
                                        <a href="{{ route('tramites.edit', $tramite) }}"
                                           class="text-[#E5C300] hover:text-[#b39600]">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="p-4 border-t flex items-center justify-between">
                    <div class="text-sm text-gray-600">
                        Mostrando <span class="font-medium">{{ count($tramites) }}</span> trámites
                    </div>
                    <div class="flex space-x-2">
                        <!-- Aquí puedes agregar la paginación si la necesitas -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.main>

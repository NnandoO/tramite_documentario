<div class="py-6">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center">
            <h1 class="text-2xl font-semibold text-gray-900">Mis Trámites</h1>
            <div class="flex items-center space-x-4">
                <div class="relative">
                    <input type="text" placeholder="Buscar por tipo de trámite o número de expediente..." class="w-96 px-4 py-2 border rounded-lg text-gray-700 focus:outline-none focus:border-green-500">
                </div>
                <select class="px-4 py-2 border rounded-lg text-gray-700 focus:outline-none focus:border-green-500">
                    <option value="">Todos los estados</option>
                </select>
            </div>
        </div>

        <div class="mt-6">
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white rounded-lg overflow-hidden">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Expediente</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tipo de Trámite</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Estado</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Fecha Envío</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Funcionario</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach($tramites as $tramite)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4">
                                    <div>{{ $tramite['expediente'] }}</div>
                                                                </td>
                                <td class="px-6 py-4">{{ $tramite['tipo_tramite'] }}</td>
                                <td class="px-6 py-4">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">En Proceso</span>
                                </td>
                                <td class="px-6 py-4">{{ $tramite['fecha_envio'] }}</td>
                                <td class="px-6 py-4">{{ $tramite['funcionario'] }}</td>
                                <td class="px-6 py-4">
                                    <a href="#" class="text-gray-600 hover:text-gray-900">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

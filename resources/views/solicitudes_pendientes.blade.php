<x-layouts.app :title="__('Archivo Central')">
    <div class="pb-4">
        <h1 class="text-3xl font-bold text-green-800">PANEL DE SOLICITUDES PENDIENTES – ARCHIVO CENTRAL</h1>
    </div>

    <div class="max-w-5xl mx-auto bg-white shadow-md rounded-xl mt-5 p-4 space-y-6">
        <flux:input icon="magnifying-glass" placeholder="Filtrar por palabras clave" />
    </div>

    <div class="max-w-5xl mx-auto bg-white shadow-md rounded-xl mt-5 p-4 overflow-x-auto">
        <table class="w-full text-sm text-left text-gray-700">
            <thead class="text-xs text-gray-600 uppercase border-b">
                <tr>
                    <th class="px-4 py-2">Código</th>
                    <th class="px-4 py-2">Solicitante</th>
                    <th class="px-4 py-2">Expediente</th>
                    <th class="px-4 py-2">Motivo</th>
                    <th class="px-4 py-2">Fecha de solicitud</th>
                    <th class="px-4 py-2">Estado</th>
                </tr>
            </thead>
            <tbody>
                <tr class="border-b">
                    <td class="px-4 py-2">1</td>
                    <td class="px-4 py-2">Juan Pérez</td>
                    <td class="px-4 py-2">Solicitud de expediente</td>
                    <td class="px-4 py-2">Trámite ext</td>
                    <td class="px-4 py-2">10/07/2025 01:46 p.m.</td>
                    <td class="px-4 py-2">
                        <span class="bg-green-100 text-green-800 text-xs font-semibold px-2.5 py-0.5 rounded">
                            Pendiente
                        </span>
                    </td>
                </tr>
                <tr class="border-b">
                    <td class="px-4 py-2">2</td>
                    <td class="px-4 py-2">Laura Gómez</td>
                    <td class="px-4 py-2">Solicitud de expediente</td>
                    <td class="px-4 py-2">—</td>
                    <td class="px-4 py-2">10/07/2025 01:46 p.m.</td>
                    <td class="px-4 py-2">
                        <span class="bg-green-100 text-green-800 text-xs font-semibold px-2.5 py-0.5 rounded">
                            Atendido
                        </span>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</x-layouts.app>

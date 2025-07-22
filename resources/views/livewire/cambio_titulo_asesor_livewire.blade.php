<div class="min-h-screen bg-[#E0E0E0] px-4 py-8">
    <!-- Título centrado -->
    <div class="max-w-6xl mx-auto bg-white p-4 rounded shadow text-center mb-6">
        <h2 class="text-2xl font-bold" style="color: #E5C300;">CAMBIO DE TÍTULO DEL PLAN DE TESIS</h2>
    </div>

    <!-- Contenedor principal -->
    <div class="max-w-6xl mx-auto bg-white p-6 rounded shadow space-y-8">
        <!-- Información -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <h3 class="font-bold text-black">Descripción :</h3>
                <p class="font-bold mt-2">Requisitos</p>
                <ul class="list-decimal list-inside text-sm mt-1">
                    <li>SOLICITUD DIRIGIDA AL DECANO DE LA FACULTAD</li>
                    <li>INFORME JUSTIFICATORIO DEL ASESOR</li>
                    <li>PAGO POR DERECHO DE TRÁMITE DOCUMENTARIO</li>
                </ul>
            </div>
            <div>
                <h3 class="font-bold text-black">Detalles :</h3>
                <ul class="list-disc list-inside text-sm mt-2">
                    <li>Duración : 5 días</li>
                    <li>Área Inicio: Unidad de Administración Documentaria</li>
                    <li>Dependencia: Sin Asignar</li>
                </ul>

                <p class="font-bold mt-4 text-black">Requisitos :</p>
                <ul class="list-disc list-inside text-sm mt-1">
                    <li>SOLICITUD DIRIGIDA AL DECANO DE LA FACULTAD</li>
                    <li>INFORME JUSTIFICATORIO DEL ASESOR</li>
                    <li>PAGO POR DERECHO DE TRÁMITE DOCUMENTARIO</li>
                </ul>
            </div>
        </div>

        <!-- Sustento -->
        <div>
            <label class="block font-bold text-black mb-2">Asunto:</label>
            <textarea wire:model="asunto"
                      placeholder="Ingresar asunto ....."
                      class="w-full border border-gray-400 p-4 rounded resize-none h-40 text-sm"
                      id="asunto" style="height: 280px;"></textarea>
        </div>

        <!-- Archivos -->
        <div class="border-t border-black pt-4">
    <h4 class="font-bold text-black mb-4">Requisito</h4>
    <div class="space-y-2">

        <!-- Requisito 1 -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-y-2 items-start">
            <p class="mb-0">SOLICITUD DIRIGIDA AL DECANO DE LA FACULTAD</p>
            <label class="relative w-full" wire:key="archivo1">
                <input type="file" wire:model="archivo1" class="hidden">
                <div class="custom-file-label border p-2 bg-white cursor-pointer text-gray-600 rounded w-full text-center">
                    {{ $archivo1_nombre }}
                </div>
            </label>
        </div>

        <!-- Requisito 2 -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-y-2 items-start">
            <p class="mb-0">INFORME JUSTIFICATORIO DEL ASESOR</p>
            <label class="relative w-full" wire:key="archivo2">
                <input type="file" wire:model="archivo2" class="hidden">
                <div class="custom-file-label border p-2 bg-white cursor-pointer text-gray-600 rounded w-full text-center">
                    {{ $archivo2_nombre }}
                </div>
            </label>
        </div>

        <!-- Requisito 3 -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-y-2 items-start">
            <p class="mb-0">PAGO POR DERECHO DE TRÁMITE DOCUMENTARIO</p>
            <label class="relative w-full" wire:key="archivo3">
                <input type="file" wire:model="archivo3" class="hidden">
                <div class="custom-file-label border p-2 bg-white cursor-pointer text-gray-600 rounded w-full text-center">
                    {{ $archivo3_nombre }}
                </div>
            </label>
        </div>

    </div>
</div>


        <!-- Botones -->
        <div style="width: 100%; text-align: center; padding-top: 1.5rem;">

            <!-- Botón ENVIAR -->
            <button wire:click="enviarFormulario"
                style="background-color: #22572D; color: white; padding: 0.5rem 1.5rem; border-radius: 0.375rem; cursor: pointer; margin-right: 1rem; border: none;">
                + ENVIAR SOLICITUD
            </button>

            <!-- Botón CANCELAR -->
            <button wire:click="resetForm"
                style="background-color: #B91C1C; color: white; padding: 0.5rem 1.5rem; border-radius: 0.375rem; cursor: pointer; border: none;">
                X CANCELAR SOLICITUD
            </button>

        </div>
    </div>
</div>
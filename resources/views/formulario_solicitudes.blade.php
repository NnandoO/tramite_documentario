<x-layouts.app :title="__('Archivo Central')"> 
    <!-- Título principal -->
    <div class="pb-4">
        <h1 class="text-3xl font-bold text-green-800">Formulario de solicitud de expediente</h1>
    </div>

    <!-- Contenedor principal -->
    <div class="max-w-5xl mx-auto bg-white shadow-md rounded-xl mt-5 p-6 space-y-6">

        <!-- Primera fila de campos -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <flux:input label="Nombre del solicitante" placeholder="Juan Pérez" icon="user" wire:model.defer="nombre" />

            <flux:input label="Número o código de expediente" placeholder="Escribe tu respuesta ..." icon="hashtag" wire:model.defer="codigo" />

            <flux:select label="Facultad" placeholder="Selecciona facultad" wire:model.defer="facultad">
                <flux:select.option>SISTEMAS</flux:select.option>
                <flux:select.option>MEDICINA HUMANA</flux:select.option>
                <flux:select.option>ADMINISTRACIÓN</flux:select.option>
            </flux:select>

            <flux:input label="Fecha" type="date" placeholder="MM/DD/AA" icon="calendar" wire:model.defer="fecha" />
        </div>

        <!-- Segunda fila de campos -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <flux:input label="Tipo de trámite" placeholder="Escribe tu respuesta ..." icon="document" wire:model.defer="tipo" />

            <div class="flex flex-col">
                <label class="text-gray-700 font-semibold">¿El expediente es restringido?</label>
                <div class="flex gap-4 mt-2">
                    <label class="flex items-center gap-2">
                        <input type="radio" wire:model.defer="restringido" value="no" />
                        No
                    </label>
                    <label class="flex items-center gap-2">
                        <input type="radio" wire:model.defer="restringido" value="sí" />
                        Sí
                    </label>
                </div>
            </div>
        </div>

        <!-- Motivo de solicitud -->
        <flux:textarea
            label="Motivo de la solicitud"
            placeholder="Escribe tu respuesta al solicitante ..."
            wire:model.defer="motivo"
        />

        <!-- Subida de archivos -->
        <flux:input
            type="file"
            label="Adjuntar archivo"
            wire:model.defer="archivo"
            class="file:bg-yellow-400 file:text-black hover:file:bg-yellow-500"
        />

        <!-- Botones -->
        <div class="flex justify-end gap-4">
            <flux:button color="gray">Cancelar</flux:button>
            <flux:button color="green">Enviar</flux:button>
        </div>

    </div>
</x-layouts.app>

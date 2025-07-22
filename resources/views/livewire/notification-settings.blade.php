<div class="p-4 border rounded bg-white">
    <h3 class="text-lg font-semibold mb-4">Configuración de Notificaciones</h3>

    {{-- Mensaje de éxito o error --}}
    @if(session()->has('success'))
        <div class="bg-green-100 text-green-700 p-2 rounded mb-4 text-sm">
            {{ session('success') }}
        </div>
    @endif
    @if(session()->has('error'))
        <div class="bg-red-100 text-red-700 p-2 rounded mb-4 text-sm">
            {{ session('error') }}
        </div>
    @endif

    <form wire:submit.prevent="save" class="space-y-4">
        <div>
            <label class="inline-flex items-center text-gray-700">
                <input type="checkbox" wire:model="database_enabled" class="form-checkbox h-5 w-5 text-blue-600 rounded" />
                <span class="ml-2 text-base">Notificaciones en la aplicación (bandeja)</span>
            </label>
            <p class="text-sm text-gray-500 ml-7">Recibir alertas directamente en la campana de notificaciones de la aplicación.</p>
        </div>

        <div>
            <label class="inline-flex items-center text-gray-700">
                <input type="checkbox" wire:model="email_enabled" class="form-checkbox h-5 w-5 text-blue-600 rounded" />
                <span class="ml-2 text-base">Correo Electrónico</span>
            </label>
            <p class="text-sm text-gray-500 ml-7">Recibir un correo electrónico para cada nueva notificación.</p>
        </div>

        <div>
            <label class="inline-flex items-center text-gray-700">
                <input type="checkbox" wire:model="push_enabled" class="form-checkbox h-5 w-5 text-blue-600 rounded" />
                <span class="ml-2 text-base">Notificaciones push (en desarrollo)</span>
            </label>
            <p class="text-sm text-gray-500 ml-7">Recibir notificaciones directamente en tu navegador (requiere configuración adicional del navegador).</p>
        </div>

        <div class="border-t pt-4">
            <label class="block font-medium text-gray-700 mb-2">Horario preferido para notificaciones (opcional)</label>
            <p class="text-sm text-gray-500 mb-2">Si configuras un horario, solo recibirás notificaciones en este rango de tiempo.</p>
            <div class="flex flex-col md:flex-row gap-4 items-center">
                <div class="flex-1 w-full">
                    <label for="start_time" class="block text-sm font-medium text-gray-700">Desde</label>
                    <input type="time" id="start_time" wire:model.lazy="start_time"
                           class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500" />
                    @error('start_time') <span class="text-red-600 text-xs mt-1">{{ $message }}</span> @enderror
                </div>
                <div class="flex-1 w-full">
                    <label for="end_time" class="block text-sm font-medium text-gray-700">Hasta</label>
                    <input type="time" id="end_time" wire:model.lazy="end_time"
                           class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500" />
                    @error('end_time') <span class="text-red-600 text-xs mt-1">{{ $message }}</span> @enderror
                </div>
            </div>
             <button type="button" wire:click="$set('start_time', null); $set('end_time', null);" class="mt-2 text-sm text-gray-600 hover:text-gray-900 underline">
                Limpiar horario
            </button>
        </div>

        <div class="flex justify-end pt-4 border-t">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                Guardar Cambios
            </button>
        </div>
    </form>
</div>
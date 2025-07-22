<div class="h-full overflow-auto p-6 space-y-6 bg-white border border-gray-200 rounded-2xl shadow-lg">

    {{-- Mensaje de éxito --}}
    <div 
        x-data="{ show: @entangle('showSuccess') }" 
        x-show="show" 
        x-transition
        x-init="$watch('show', value => { if(value) setTimeout(() => show = false, 4000) })"
        class="p-4 text-green-800 bg-green-100 border border-green-300 rounded-lg font-medium"
    >
        ✅ Perfil actualizado correctamente.
    </div>

    {{-- Panel de datos actuales --}}
    <div class="flex flex-col lg:flex-row gap-6 border-b pb-6">
        {{-- Imagen del usuario --}}
        <div class="flex-shrink-0 self-center">
            <div class="flex items-center justify-center rounded-full bg-neutral-200 text-black text-4xl font-bold dark:bg-neutral-700 dark:text-white border shadow"
                style="width: 128px; height: 128px;">
                {{ auth()->user()->initials() }}
            </div>
        </div>

        {{-- Información personal --}}
        <div class="grid gap-3 text-sm flex-1">
            @foreach([
                'Nombre(s)' => auth()->user()->name,
                'Apellidos' => auth()->user()->last_name,
                'Correo' => auth()->user()->email,
                'Cargo' => auth()->user()->cargo ?? 'Sin asignar',
                'Dependencia' => auth()->user()->dependencia ?? 'Sin asignar'
            ] as $label => $value)
            <div class="flex items-center">
                <div class="text-gray-800">
                    <span class="text-gray-600 font-medium">{{ $label }}:  </span>{{ $value }}
                </div>
            </div>
            @endforeach
        </div>
    </div>

    {{-- Formulario de actualización --}}
    <div class="space-y-6">
        <h2 class="text-xl font-semibold text-gray-800 border-b pb-2">✏ Actualizar datos</h2>

        <div class="grid gap-6 max-w-md">
            {{-- Correo --}}
            <div>
                <label class="block font-medium text-sm text-gray-700 mb-1">Correo Electrónico</label>
                <input type="email" wire:model.defer="email"
                    class="w-full p-2 border rounded-lg bg-white shadow-sm focus:outline-none focus:ring focus:border-blue-300"
                    placeholder="ej. funcionario@uncp.edu.pe">
                @error('email') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>

            {{-- Cargo --}}
            <div>
                <label class="block font-medium text-sm text-gray-700 mb-1">Cargo</label>
                <select wire:model.defer="cargo" 
                    class="w-full p-2 border rounded-lg bg-white shadow-sm focus:outline-none focus:ring focus:border-blue-300">
                    <option value="">Seleccione...</option>
                    <option>Cargo 1</option>
                    <option>Cargo 2</option>
                    <option>Cargo 3</option>
                    <option>Cargo 4</option>
                    <option>Cargo 5</option>
                </select>
                @error('cargo') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>

            {{-- Dependencia --}}
            <div>
                <label class="block font-medium text-sm text-gray-700 mb-1">Dependencia</label>
                <select wire:model.defer="dependencia" 
                    class="w-full p-2 border rounded-lg bg-white shadow-sm focus:outline-none focus:ring focus:border-blue-300">
                    <option value="">Seleccione...</option>
                    <option>Dependencia 1</option>
                    <option>Dependencia 2</option>
                    <option>Dependencia 3</option>
                    <option>Dependencia 4</option>
                    <option>Dependencia 5</option>
                </select>
                @error('dependencia') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>
        </div>

        {{-- Boton --}}
        <div class="flex gap-4 pt-4 mt-4 border-t">
            <button wire:click="actualizar"
                class="relative z-50 bg-green-800 hover:bg-green-900 text-white font-semibold py-2 px-6 rounded shadow cursor-pointer">
                💾Guardar cambios
            </button>
        </div>
    </div>
</div>
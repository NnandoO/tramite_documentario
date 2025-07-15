<x-layouts.app :title="__('Carga de documentos digitalizados')">
    <div class="pb-4">
        <h1 class="text-3xl font-bold text-green-800">Carga de documentos digitalizados</h1>
    </div>
    <div class="max-w-5xl mx-auto mt-4 bg-white shadow-md p-8 rounded-xl space-y-6"></h1>

        <!-- Mensaje de éxito -->
        @if(session('success'))
            <div class="p-4 bg-green-100 text-green-800 rounded-md">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('documentos.subir') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf

            <!-- Select estático con expedientes -->
            <flux:select wire:model="industry" placeholder="Seleccione un expediente...">
            <flux:select.option>Expediente 1</flux:select.option>
            <flux:select.option>Expediente 2</flux:select.option>
            <flux:select.option>Expediente 3</flux:select.option>on>
            </flux:select>


            <!-- Input de archivos -->
            <div>
                <flux:input
                    type="file"
                    wire:model="attachments"
                    label="Documentos (.PDF)"
                    multiple
                    class="file:bg-amber-300 file:text-black hover:file:bg-yellow-500"
                />
            </div>

            <flux:button variant="primary" color="yellow">Cargar documentos</flux:button>
        </form>
    </div>
</x-layouts.app>

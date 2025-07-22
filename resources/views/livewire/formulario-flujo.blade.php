<div>
    @push('styles')
        <link rel="stylesheet" href="{{ asset('css/formularioFlujo.css') }}">
    @endpush

    <div class="contenedor">
        <h2>No se encontró un trámite predefinido en el eDoc. Complete los datos para generar flujo personalizado.</h2>

        @if (session('success'))
            <div class="bg-green-200 text-green-800 p-2 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <form wire:submit.prevent="archivar">
            <label>Número de expediente</label>
            <input type="text" wire:model.defer="codigo">

            <label>Nombre del solicitante</label>
            <input type="text" wire:model.defer="solicitante">

            <div class="row">
                <div class="col">
                    <label>Asunto del trámite</label>
                    <input type="text" wire:model.defer="asunto">
                </div>
                <div class="col">
                    <label>Tipo de documento</label>
                    <input type="text" wire:model.defer="tipo_documento">
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <label>Área de procedencia</label>
                    <input type="text" wire:model.defer="area_procedencia">
                </div>
                <div class="col">
                    <label>Fecha de recepción</label>
                    <input type="date" wire:model.defer="fecha_recepcion">
                </div>
            </div>

            <label>Subir documento</label>
            <div class="upload">
                <input type="file" wire:model="documento" accept=".pdf,image/*">
                <span>PDF o imagen</span>
            </div>

            <label>Observaciones</label>
            <textarea rows="4" wire:model.defer="observaciones"></textarea>

            <div class="acciones">
                <button type="submit" class="btn verde">Archivar</button>
                <a href="{{ route('formularioFlujo') }}" class="btn blanco">Limpiar campos</a>
                <button type="button" class="btn rojo" wire:click="cancelar">Cancelar</button>
            </div>
        </form>
    </div>
</div>

<div>
    @push('styles')
        <link rel="stylesheet" href="{{ asset('css/remisionExpediente.css') }}">
    @endpush

    <div class="w-full px-4 md:px-10 py-6">
        @if ($expediente)
            <div class="contenedor">
                <h2 class="titulo-seccion">DATOS DEL EXPEDIENTE</h2>

                <div class="datos-box">
                    <div class="fila">
                        <div class="etiqueta">N° Expediente</div>
                        <div class="valor">{{ $expediente->codigo }}</div>
                    </div>
                    <div class="fila">
                        <div class="etiqueta">Nombre del solicitante</div>
                        <div class="valor">{{ $expediente->solicitante }}</div>
                    </div>
                    <div class="fila">
                        <div class="etiqueta">Fecha validación</div>
                        <div class="valor">
                            {{ $expediente->fecha_validacion
                                ? \Carbon\Carbon::parse($expediente->fecha_validacion)->format('d/m/Y h:i A')
                                : 'No validado aún' }}
                        </div>
                    </div>
                    <div class="fila">
                        <div class="etiqueta">Estado</div>
                        <div class="valor">{{ $expediente->estado }}</div>
                    </div>
                    <div class="fila">
                        <div class="etiqueta">Medio de envío</div>
                        <div class="valor">
                            <select wire:model="medio">
                                <option>Sistema eDoc</option>
                                <option>Otro medio</option>
                            </select>
                        </div>
                    </div>
                </div>

                <button class="btn-enviar" wire:click="enviarExpediente">ENVIAR EXPEDIENTE</button>
            </div>
        @else
            <div class="text-center text-gray-600 bg-white p-8 rounded shadow-md">
                <h2 class="text-xl font-semibold mb-4">Seleccione un expediente desde la lista</h2>
                <p class="text-sm">Este apartado solo se muestra cuando se selecciona un expediente aprobado para remisión.</p>
            </div>
        @endif
    </div>
</div>

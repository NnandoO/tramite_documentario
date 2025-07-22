<div>
    <h2 class="text-2xl font-bold mb-4 text-gray-800">Trámites por archivar</h2>

    <div class="overflow-auto rounded-lg shadow-sm bg-white">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Código</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Solicitante</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Fecha ingreso</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Acción</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($requests as $req)
                    <tr>
                        <td class="px-4 py-2 whitespace-nowrap text-sm text-gray-700">{{ $req->expediente->codigo }}</td>
                        <td class="px-4 py-2 whitespace-nowrap text-sm text-gray-700">{{ $req->expediente->solicitante }}</td>
                        <td class="px-4 py-2 whitespace-nowrap text-sm text-gray-700">{{ $req->expediente->fecha_ingreso }}</td>
                        <td class="px-4 py-2 whitespace-nowrap text-sm">
                            <flux:button size="sm" variant="primary" wire:click="selectRequest({{ $req->id }})">
                                <flux-icon name="pencil" class="w-4 h-4 mr-1" />
                                Procesar
                            </flux:button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-4 py-8 text-center text-gray-500">No hay solicitudes.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($selectedRequest)
        <div class="mt-8 max-w-xl mx-auto bg-white p-6 rounded-lg shadow-md">
            <h3 class="text-xl font-semibold mb-4">Detalle del trámite</h3>

            <p class="text-sm text-gray-700"><strong>Código:</strong> {{ $selectedRequest->expediente->codigo }}</p>
            <p class="text-sm text-gray-700 mb-4"><strong>Solicitante:</strong> {{ $selectedRequest->expediente->solicitante }}</p>

            <div class="mt-4">
                <label for="fecha" class="block mb-1 font-semibold text-gray-700">Fecha Ingreso:</label>
                <input type="date" id="fecha" wire:model.defer="fecha" class="form-control" />
                @error('fecha') 
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                @enderror
            </div>

            <div class="mt-4">
                <label for="estado" class="block mb-1 font-semibold text-gray-700">Estado:</label>
                <select id="estado" wire:model.defer="estado" class="form-control">
                    <option value="En Proceso">En Proceso</option>
                    <option value="Finalizado">Finalizado</option>
                    <option value="Pendiente">Pendiente</option>
                </select>
                @error('estado') 
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                @enderror
            </div>

            <div class="mt-4">
                <label for="tipo" class="block mb-1 font-semibold text-gray-700">Tipo de Trámite:</label>
                <select id="tipo" wire:model.defer="tipo" class="form-control" onchange="mostrarOtroTipo()">
                    <option>Solicitud de Copia</option>
                    <option>Registro Nuevo</option>
                    <option>Actualización de Datos</option>
                    <option>Otro</option>
                </select>
                <input type="text" id="otroTipo" wire:model.defer="otroTipo" class="form-control mt-2" style="display: none;" placeholder="Especificar otro tipo..." />
                @error('otroTipo') 
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                @enderror
            </div>

            <div class="mt-4">
                <label for="facultad" class="block mb-1 font-semibold text-gray-700">Facultad:</label>
                <select id="facultad" wire:model.defer="facultad" class="form-control">
                    <option>Ingeniería</option>
                    <option>Ciencias Administrativas</option>
                    <option>Derecho</option>
                    <option>Educación</option>
                    <option>Otra</option>
                </select>
                @error('facultad') 
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                @enderror
            </div>

            <div class="mt-4">
                <label for="ubicacion" class="block mb-1 font-semibold text-gray-700">Ubicación Física:</label>
                <input type="text" id="ubicacion" wire:model.defer="ubicacion" class="form-control" placeholder="Ej. Estante 3, Caja 5, Archivo B" />
                @error('ubicacion') 
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                @enderror
            </div>

            <div class="mt-4">
                <label for="comentario" class="block mb-1 font-semibold text-gray-700">Comentarios:</label>
                <textarea id="comentario" wire:model.defer="comentario" class="form-control" placeholder="Observaciones adicionales..."></textarea>
                @error('comentario') 
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                @enderror
            </div>

            <div class="flex justify-end items-center gap-3 mt-6">
                <flux:button wire:click="previsualizarPDF">
                    <flux-icon name="eye" class="w-4 h-4 mr-1" />
                    Previsualizar
                </flux:button>
                <flux:button wire:click="descargarPDF">
                    <flux-icon name="document-arrow-down" class="w-4 h-4 mr-1" />
                    Exportar PDF
                </flux:button>
                <flux:button wire:click="cancelar">
                    Cancelar
                </flux:button>
            </div>

            <div class="pdf-preview mt-4" id="pdfPreviewContainer">
                <div class="pdf-placeholder" id="pdfPlaceholder">
                    <i class="fas fa-file-pdf"></i>
                    <p>Previsualización del documento PDF</p>
                    <small>Haz clic en "Previsualizar" para generar el documento</small>
                </div>
                <iframe id="visor" style="display: none;"></iframe>
            </div>
        </div>
    @endif
</div>
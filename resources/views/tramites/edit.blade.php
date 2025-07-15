<x-layouts.main>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.main>      <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <h2 class="text-2xl font-bold mb-6" style="color: #22572D;">Editar Trámite</h2>

                <form action="{{ route('tramites.update', $tramite) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Número de Expediente</label>
                        <div class="mt-1">
                            <input type="text" value="{{ $tramite->expediente }}" disabled
                                   class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm bg-gray-50">
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Tipo de Trámite</label>
                        <div class="mt-1">
                            <input type="text" value="{{ $tramite->tipo_tramite }}" disabled
                                   class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm bg-gray-50">
                        </div>
                    </div>

                    <!-- Campos editables según el tipo de trámite -->
                    <div class="space-y-4">
                        @if(str_contains($tramite->tipo_tramite, 'CAMBIO DE ASESOR'))
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Nuevo Asesor</label>
                                <input type="text" name="nuevo_asesor" value="{{ old('nuevo_asesor', $tramite->nuevo_asesor) }}"
                                       class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Justificación del Cambio</label>
                                <textarea name="justificacion" rows="4"
                                          class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500">{{ old('justificacion', $tramite->justificacion) }}</textarea>
                            </div>
                        @elseif(str_contains($tramite->tipo_tramite, 'DESIGNACIÓN DE JURADO'))
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Título del Proyecto</label>
                                <input type="text" name="titulo_proyecto" value="{{ old('titulo_proyecto', $tramite->titulo_proyecto) }}"
                                       class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Asesor Actual</label>
                                <input type="text" name="asesor_actual" value="{{ old('asesor_actual', $tramite->asesor_actual) }}"
                                       class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500">
                            </div>
                        @elseif(str_contains($tramite->tipo_tramite, 'CARTA DE NO ADEUDO'))
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Tipo de No Adeudo</label>
                                <select name="tipo_no_adeudo"
                                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500">
                                    <option value="LABORATORIO" {{ old('tipo_no_adeudo', $tramite->tipo_no_adeudo) == 'LABORATORIO' ? 'selected' : '' }}>Laboratorio</option>
                                    <option value="BIBLIOTECA" {{ old('tipo_no_adeudo', $tramite->tipo_no_adeudo) == 'BIBLIOTECA' ? 'selected' : '' }}>Biblioteca</option>
                                </select>
                            </div>
                        @endif

                        <!-- Campo para adjuntar archivos -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Documentos Adjuntos</label>
                            <input type="file" name="documentos[]" multiple
                                   class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500">
                            <p class="mt-1 text-sm text-gray-500">Puede adjuntar múltiples documentos en formato PDF.</p>
                        </div>

                        @if($tramite->documentos)
                            <div class="mt-4">
                                <h4 class="text-sm font-medium text-gray-700 mb-2">Documentos Actuales:</h4>
                                <ul class="list-disc pl-5 space-y-1">
                                    @foreach(json_decode($tramite->documentos) as $documento)
                                        <li class="text-sm text-gray-600">
                                            {{ basename($documento) }}
                                            <button type="button" name="eliminar_documento" value="{{ $documento }}"
                                                    class="ml-2 text-red-600 hover:text-red-800">
                                                Eliminar
                                            </button>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </div>

                    <div class="flex justify-end space-x-4">
                        <a href="{{ route('tramites.index') }}"
                           class="px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                            Cancelar
                        </a>
                        <button type="submit"
                                style="background-color: #22572D;"
                                class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white hover:bg-green-700">
                            Guardar Cambios
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>

<x-layouts.main>
    <div class="flex items-center mb-4">
        <a href="{{ route('tramites.index') }}" class="text-gray-600 hover:text-gray-800 mr-2">
            <i class="fas fa-arrow-left"></i>
        </a>
        <span class="text-gray-600">Sistema de Trámite Documentario</span>
    </div>

    <div class="bg-white shadow-sm">
        <h1 class="text-2xl font-bold text-[#E5C300] p-4 border-b">{{ $titulo }}</h1>

        <div class="grid grid-cols-2 gap-8 p-6">
            <!-- Columna izquierda - Descripción y Requisitos -->
            <div class="space-y-6">
                <div>
                    <h3 class="text-gray-700 font-medium mb-2">Descripción :</h3>
                    <p class="text-gray-600">{{ $descripcion }}</p>
                </div>

                <div>
                    <h3 class="text-gray-700 font-medium mb-2">REQUISITOS</h3>
                    <ul class="list-none space-y-2">
                        @foreach($requisitos as $requisito)
                            <li class="flex items-start text-gray-600">
                                <span class="mr-2">•</span>
                                <span>{{ $requisito }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <!-- Columna derecha - Formulario -->
            <div class="bg-gray-50 p-6 rounded">
                <div class="mb-6">
                    <h3 class="text-gray-700 font-medium mb-2">Detalles :</h3>
                    <ul class="space-y-1 text-gray-600 text-sm">
                        <li>• Duración: {{ $duracion }}</li>
                        <li>• Área Inicio: Unidad de Administración Documentaria</li>
                        <li>• Dependencia: Sin Asignar</li>
                    </ul>
                </div>

                <form action="{{ route('tramites.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="tipo_tramite" value="{{ $tipo_tramite }}">

                    <div class="space-y-4">
                        <div>
                            <label class="text-gray-700 font-medium mb-2">Sustento:</label>
                            <textarea
                                name="sustento"
                                rows="2"
                                class="mt-1 block w-full rounded border-gray-300 shadow-sm focus:border-[#22572D] focus:ring focus:ring-[#22572D] focus:ring-opacity-50"
                                placeholder="Ingrese sustento"></textarea>
                        </div>

                        <!-- Tabla de Requisitos y Archivos -->
                        <div class="mt-4">
                            <table class="w-full">
                                <thead>
                                    <tr>
                                        <th class="text-left pb-2 text-gray-700 font-medium">Requisito</th>
                                        <th class="text-left pb-2 text-gray-700 font-medium">Archivo</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200">
                                    @foreach($documentos as $documento)
                                    <tr>
                                        <td class="py-2 text-gray-600">{{ $documento }}</td>
                                        <td class="py-2">
                                            <input
                                                type="file"
                                                name="documentos[]"
                                                class="block w-full text-sm file:mr-4 file:py-2 file:px-4 file:rounded file:border-0 file:text-sm file:bg-gray-100 file:text-gray-700 hover:file:bg-gray-200"
                                                accept=".pdf,.jpg,.jpeg,.png"
                                                required>
                                            <button type="button" class="mt-1 text-[#22572D] text-sm hover:text-[#1a4423]">BUSCAR</button>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        @if(in_array('Foto', $documentos))
                        <div class="mt-4">
                            <div class="w-32 h-32 mx-auto bg-gray-200 rounded-full flex items-center justify-center">
                                <img id="preview-foto" src="" alt="" class="w-full h-full rounded-full object-cover hidden">
                                <i class="fas fa-user text-4xl text-gray-400" id="default-foto"></i>
                            </div>
                        </div>
                        @endif

                        <div class="mt-6 flex justify-end">
                            <button
                                type="submit"
                                class="bg-[#22572D] text-white px-4 py-2 rounded hover:bg-[#1a4423] focus:outline-none focus:ring-2 focus:ring-[#22572D] focus:ring-opacity-50">
                                + ENVIAR SOLICITUD
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-layouts.main>

@push('scripts')
<script>
    // Preview de la foto
    document.querySelectorAll('input[type="file"]').forEach(input => {
        input.addEventListener('change', function(e) {
            if (this.accept.includes('image') && this.files && this.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('preview-foto').src = e.target.result;
                    document.getElementById('preview-foto').classList.remove('hidden');
                    document.getElementById('default-foto').classList.add('hidden');
                }
                reader.readAsDataURL(this.files[0]);
            }
        });
    });
</script>
@endpush

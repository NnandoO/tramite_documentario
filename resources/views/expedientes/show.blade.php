@php use Illuminate\Support\Facades\Storage; @endphp
<x-layouts.app :title="$expediente->nombre">
    <div class="container mx-auto grid max-w-3xl gap-6 p-6">
        <h1 class="text-2xl font-bold">{{ $expediente->nombre }}</h1>

        <section class="grid gap-2 text-sm">
            <div><span class="font-medium">{{ __('Tipo de trámite:') }}</span> {{ $expediente->tramite->nombre }}</div>
            <div><span class="font-medium">{{ __('Facultad:') }}</span> {{ $expediente->facultad->nombre }}</div>
            <div><span class="font-medium">{{ __('Fecha del expediente:') }}</span> {{ $expediente->fecha_expediente->format('Y-m-d') }}</div>
        </section>

        <section class="grid gap-4">
            <h2 class="text-xl font-semibold">{{ __('Documentos') }}</h2>

            @if(session('success'))
                <div class="rounded bg-green-100 p-2 text-sm text-green-800">{{ session('success') }}</div>
            @endif

            <form method="POST" action="{{ route('expedientes.documents.upload', $expediente) }}" enctype="multipart/form-data" class="grid gap-4">
                @csrf
                <x-form.upload label="{{ __('Seleccionar documentos') }}" :errors="$errors->get('documents')" />
                <div class="flex justify-end">
                    <button type="submit" class="rounded bg-indigo-600 px-4 py-2 text-sm font-medium text-white hover:bg-indigo-700">+ {{ __('Cargar documentos') }}</button>
                </div>
            </form>

            <div class="overflow-x-auto">
                <table class="min-w-full text-sm">
                    <thead class="text-left font-medium text-gray-700 dark:text-gray-200">
                        <tr>
                            <th class="p-2">{{ __('Nombre') }}</th>
                            <th class="p-2">{{ __('Fecha') }}</th>
                            <th class="p-2">{{ __('Hora') }}</th>
                            <th class="p-2">{{ __('Tamaño') }}</th>
                            <th class="p-2"></th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                        @foreach($expediente->documentos as $documento)
                            <tr>
                                <td class="p-2">{{ basename($documento->ruta) }}</td>
                                <td class="p-2">{{ $documento->uploaded_at->format('Y-m-d') }}</td>
                                <td class="p-2">{{ $documento->uploaded_at->format('H:i') }}</td>
                                <td class="p-2">{{ number_format($documento->size / 1024, 2) }} KB</td>
                                <td class="p-2 flex gap-2">
                                    <a href="{{ Storage::url($documento->ruta) }}" target="_blank" class="text-blue-600 hover:underline">{{ __('Ver') }}</a>
                                    <a href="{{ Storage::url($documento->ruta) }}" download class="text-blue-600 hover:underline">{{ __('Descargar') }}</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </section>
    </div>
</x-layouts.app>

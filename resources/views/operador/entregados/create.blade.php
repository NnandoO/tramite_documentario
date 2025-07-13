@extends('operator.dashboard')

@section('module')
    <div class="container mx-auto max-w-xl p-6">
        <h1 class="text-xl font-semibold mb-4">{{ __('Subir Copia de Expediente') }}</h1>
        <form method="POST" action="{{ route('operador.solicitudes.entregar.store', $solicitud->id) }}" enctype="multipart/form-data" class="grid gap-4">
            @csrf
            <x-form.upload name="files[]" label="{{ __('Seleccionar archivos') }}" :errors="$errors->get('files.*')" />
            <div class="flex justify-end">
                <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">
                    {{ __('Entregar') }}
                </button>
            </div>
        </form>
    </div>
@endsection

@extends('operator.dashboard')

@section('module')
    <div class="container mx-auto p-4">
        <h1 class="text-xl font-semibold mb-4">{{ __('Evaluar Solicitud') }}</h1>
        <div class="mb-4">
            <p>{{ __('Solicitante: :name', ['name' => $solicitud->nombre_solicitante]) }}</p>
            <p>{{ __('Código: :code', ['code' => $solicitud->codigo_expediente]) }}</p>
            <p>{{ __('Motivo: :motivo', ['motivo' => $solicitud->motivo]) }}</p>
        </div>
        <form method="POST" action="#">
            @csrf
            <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded mr-2">{{ __('Marcar como evaluada') }}</button>
            <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded">{{ __('Rechazar') }}</button>
        </form>
    </div>
@endsection

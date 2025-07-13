@extends('operator.dashboard')

@section('module')
    <div class="container mx-auto p-4">
        <h1 class="text-xl font-semibold mb-4">{{ __('Detalle de la Solicitud') }}</h1>
        <div class="grid gap-2">
            <p>{{ __('Solicitante: :name', ['name' => $solicitud->nombre_solicitante]) }}</p>
            <p>{{ __('Código: :code', ['code' => $solicitud->codigo_expediente]) }}</p>
            <p>{{ __('Fecha: :date', ['date' => $solicitud->fecha->format('Y-m-d')]) }}</p>
            <p>{{ __('Motivo: :motivo', ['motivo' => $solicitud->motivo]) }}</p>
            <p>{{ __('Observaciones: :obs', ['obs' => $solicitud->observaciones]) }}</p>
            <p>{{ __('Estado: :state', ['state' => $solicitud->status]) }}</p>
        </div>
    </div>
@endsection

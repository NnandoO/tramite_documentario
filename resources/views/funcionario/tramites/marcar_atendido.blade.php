@extends('funcionario.layout')

@section('titulo', 'Marcar como Atendido')

@section('contenido')
    <div class="card shadow-sm">
        <div class="card-header bg-white">
            <h5 class="mb-0">
                Marcar como Atendido: <strong>CN-2024-001</strong>
            </h5>
        </div>
        <div class="card-body">
            <div class="alert alert-info">
                Estás marcando el trámite <strong>CN-2024-001</strong> como atendido.
            </div>

            <form action="#" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="observacion" class="form-label">Observación</label>
                    <textarea id="observacion" name="observacion" class="form-control" required></textarea>
                </div>

                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('principal') }}" class="btn btn-secondary">Cancelar</a>
                    <button type="submit" class="btn btn-success">Confirmar</button>
                </div>
            </form>
        </div>
    </div>
@endsection

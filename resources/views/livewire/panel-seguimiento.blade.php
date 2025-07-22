<div>
    @push('styles')
        <link rel="stylesheet" href="{{ asset('css/panelSeguimiento.css') }}">
    @endpush

    <div class="contenedor">
        <h2 class="titulo">Panel de seguimiento de expedientes</h2>

        <!-- Filtro por fechas -->
        <div class="filtros-fecha">
            <label>Desde:
                <input type="date" wire:model="fechaInicio">
            </label>
            <label>Hasta:
                <input type="date" wire:model="fechaFin">
            </label>
            <button class="btn-filtrar" wire:click="cargarDatos">Filtrar</button>
        </div>

        <div class="resumen-cards">
            @foreach($resumen as $estado => $total)
                <div class="card">
                    <h3>{{ ucfirst($estado) }}</h3>
                    <p>{{ $total }} expedientes</p>
                </div>
            @endforeach
        </div>

        <h3 class="titulo-tabla">Últimos expedientes actualizados</h3>
        <div class="tabla-scroll">
            <table class="expedientes-table">
                <thead>
                    <tr>
                        <th>Código</th>
                        <th>Solicitante</th>
                        <th>Estado</th>
                        <th>Última actualización</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($expedientes as $exp)
                        <tr>
                            <td>{{ $exp->codigo }}</td>
                            <td>{{ $exp->solicitante }}</td>
                            <td>{{ $exp->estado }}</td>
                            <td>{{ $exp->updated_at }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

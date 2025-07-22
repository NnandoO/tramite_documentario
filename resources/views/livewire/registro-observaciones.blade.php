<div>
    @push('styles')
        <link rel="stylesheet" href="{{ asset('css/registroObservaciones.css') }}">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    @endpush

    <div class="contenedor">
        <h2 class="titulo-seccion">REGISTRO DE OBSERVACIÓN DE EXPEDIENTES</h2>

        <section class="card observacion-card">
            <div class="form-grid">
                <div class="form-group">
                    <label for="expediente">Expediente Nº</label>
                    <input type="text" id="expediente" value="{{ $expedienteCodigo }}" readonly>
                </div>
                <div class="form-group">
                    <label for="solicitante">Nombre del solicitante</label>
                    <input type="text" id="solicitante" value="{{ $solicitante }}" readonly>
                </div>
            </div>

            <div class="form-group radio-group">
                <label>Resultado de validación</label>
                <div class="radios">
                    <label>
                        <input type="radio" name="resultado" wire:model="resultado" value="conforme"> CONFORME
                    </label>
                    <label>
                        <input type="radio" name="resultado" wire:model="resultado" value="no_conforme"> NO CONFORME
                    </label>
                </div>
            </div>

            <div class="form-group">
                <label for="observaciones">Observaciones</label>
                <textarea id="observaciones" wire:model.defer="observaciones" placeholder="Describe aquí los motivos..."></textarea>
            </div>

            <p class="estado-expediente">
                Estado de expediente: <strong>{{ $estadoExpediente }}</strong>
            </p>

            <div class="acciones">
                <button class="guardar-btn" wire:click="guardarObservacion">Guardar observación</button>
                <button class="volver-btn" onclick="window.history.back()">Volver</button>
            </div>
        </section>
    </div>
</div>

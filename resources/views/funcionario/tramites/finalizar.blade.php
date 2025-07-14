@extends('funcionario.layout')

@section('titulo', 'Finalizar Trámite')

@section('contenido')
<div class="container my-4">
    <!-- Título -->
    <h3 class="mb-4">Finalizar Trámite</h3>

    <form method="POST" action="{{ route('tramites.procesar_finalizacion', $id) }}">
        @csrf
        
        <!-- Información del trámite -->
        <div class="card p-3 mb-4 shadow-sm">
            <h5><strong>Información del Trámite</strong></h5>
            <div class="row mt-3">
                <div class="col-md-6">
                    @php
                        $tramites = [
                            1 => [
                                'numero' => 'CN-2024-001',
                                'solicitante' => 'Gutierrez Poma Joshua',
                                'asunto' => 'Licencia de estudios',
                                'estado' => session('tramite_1_estado', 'Atendido'),
                                'fecha_asignacion' => '05/01/24',
                                'fecha_atencion' => '07/01/24'
                            ],
                            2 => [
                                'numero' => 'RB-2024-002',
                                'solicitante' => 'Lobos Asto Marcos',
                                'asunto' => 'Revisión de Borrador',
                                'estado' => session('tramite_2_estado', 'Atendido'),
                                'fecha_asignacion' => '04/01/24',
                                'fecha_atencion' => '06/01/24'
                            ],
                            3 => [
                                'numero' => 'ES-2024-003',
                                'solicitante' => 'Pedro Martínez',
                                'asunto' => 'Examen de Subsanación',
                                'estado' => session('tramite_3_estado', 'Atendido'),
                                'fecha_asignacion' => '02/01/24',
                                'fecha_atencion' => '05/01/24'
                            ],
                            4 => [
                                'numero' => 'TP-2024-004',
                                'solicitante' => 'María González',
                                'asunto' => 'Titulo profesional',
                                'estado' => session('tramite_4_estado', 'Atendido'),
                                'fecha_asignacion' => '01/01/24',
                                'fecha_atencion' => '03/01/24'
                            ],
                            5 => [
                                'numero' => 'AS-2024-005',
                                'solicitante' => 'Yurivilca Espinoza',
                                'asunto' => 'Constancia de apreciación estudiantil',
                                'estado' => session('tramite_5_estado', 'En Revisión'),
                                'fecha_asignacion' => '11/12/23',
                                'fecha_atencion' => null
                            ],
                            6 => [
                                'numero' => 'CA-2024-006',
                                'solicitante' => 'Alanya Carbajal Yandri',
                                'asunto' => 'Cambio de asesor',
                                'estado' => session('tramite_6_estado', 'Derivado'),
                                'fecha_asignacion' => '08/12/23',
                                'fecha_atencion' => null
                            ]
                        ];
                        $tramite = $tramites[$id] ?? $tramites[1];
                        
                        // CORREGIR: Obtener el estado real de la sesión
                        $estadoReal = session('tramite_' . $id . '_estado', 'Pendiente');
                        $tramite['estado'] = $estadoReal;
                    @endphp
                    
                    <p><strong>Número:</strong> {{ $tramite['numero'] }}</p>
                    <p><strong>Solicitante:</strong> {{ $tramite['solicitante'] }}</p>
                    <p><strong>Fecha de Asignación:</strong> {{ $tramite['fecha_asignacion'] }}</p>
                </div>
                <div class="col-md-6">
                    <p><strong>Asunto:</strong> {{ $tramite['asunto'] }}</p>
                    <p><strong>Estado Actual:</strong> 
                        <span class="badge 
                            @if($tramite['estado'] === 'Atendido') bg-primary
                            @elseif($tramite['estado'] === 'Pendiente') bg-warning
                            @elseif($tramite['estado'] === 'En Revisión') bg-info
                            @elseif($tramite['estado'] === 'Derivado') bg-secondary
                            @else bg-success
                            @endif">
                            {{ $tramite['estado'] }}
                        </span>
                    </p>
                    <p><strong>Fecha de Atención:</strong> {{ $tramite['fecha_atencion'] ?? 'No registrada' }}</p>
                </div>
            </div>
        </div>

        <!-- Verificación de Estado -->
        @if($tramite['estado'] !== 'Atendido')
            <div class="card p-3 mb-4 shadow-sm border-warning">
                <div class="d-flex align-items-center">
                    <i class="fas fa-exclamation-triangle text-warning me-3 fa-2x"></i>
                    <div>
                        <h6 class="mb-1 text-warning">Este trámite no está marcado como "Atendido"</h6>
                        <p class="mb-0 text-muted">
                            Para finalizar un trámite, primero debe estar marcado como "Atendido". 
                            Estado actual: <span class="badge bg-info">{{ $tramite['estado'] }}</span>
                        </p>
                        <div class="mt-2">
                            <a href="{{ route('funcionario.bandeja') }}" class="btn btn-sm btn-outline-primary">
                                <i class="fas fa-arrow-left me-1"></i>Volver a la Bandeja
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <!-- Resumen de Finalización -->
            <div class="card p-3 mb-4 shadow-sm">
                <h5><strong>Resumen de Finalización</strong></h5>
                <div class="row mt-3">
                    <div class="col-md-12">
                        <div class="alert alert-success">
                            <i class="fas fa-check-circle me-2"></i>
                            <strong>Trámite listo para finalizar:</strong> Al confirmar la finalización, el trámite será marcado como completado y se enviará una notificación al solicitante.
                        </div>
                    </div>
                </div>
            </div>

            <!-- Motivo de Finalización -->
            <div class="card p-3 mb-4 shadow-sm">
                <h5><strong>Motivo de Finalización</strong></h5>
                <div class="mt-3">
                    <div class="mb-3">
                        <label for="tipo_finalizacion" class="form-label">Tipo de Finalización <span class="text-danger">*</span></label>
                        <select class="form-select" id="tipo_finalizacion" name="tipo_finalizacion" required>
                            <option value="">Seleccione el tipo de finalización</option>
                            <option value="aprobado">Trámite Aprobado</option>
                            <option value="completado">Trámite Completado</option>
                            <option value="resuelto">Problema Resuelto</option>
                            <option value="entregado">Documento Entregado</option>
                            <option value="otro">Otro motivo</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="comentarios_finalizacion" class="form-label">Comentarios de Finalización <span class="text-danger">*</span></label>
                        <textarea class="form-control" id="comentarios_finalizacion" name="comentarios_finalizacion" rows="4" 
                                  placeholder="Describa brevemente el motivo de finalización del trámite. Este comentario será visible en el historial del trámite."
                                  required></textarea>
                        <div class="form-text">Mínimo 20 caracteres requeridos</div>
                    </div>

                    <div class="mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="notificar_solicitante" name="notificar_solicitante" checked>
                            <label class="form-check-label" for="notificar_solicitante">
                                Notificar al solicitante sobre la finalización del trámite
                            </label>
                        </div>
                    </div>

                    <div class="mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="generar_reporte" name="generar_reporte">
                            <label class="form-check-label" for="generar_reporte">
                                Generar reporte de finalización automáticamente
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Archivos Adjuntos (Opcional) -->
            <div class="card p-3 mb-4 shadow-sm">
                <h5><strong>Documentos Finales (Opcional)</strong></h5>
                <div class="mt-3">
                    <div class="mb-3">
                        <label for="archivos_finales" class="form-label">Adjuntar documentos finales</label>
                        <input class="form-control" type="file" id="archivos_finales" name="archivos_finales[]" multiple 
                               accept=".pdf,.doc,.docx,.jpg,.jpeg,.png">
                        <div class="form-text">Archivos que se entregarán al solicitante junto con la finalización</div>
                    </div>
                </div>
            </div>
        @endif

        <!-- Botones de acción -->
        <div class="d-flex justify-content-end gap-2">
            <a href="{{ route('principal') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-2"></i>Cancelar
            </a>
            @if($tramite['estado'] === 'Atendido')
                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalConfirmarFinalizacion">
                    <i class="fas fa-check-double me-2"></i>Finalizar Trámite
                </button>
            @else
                <button type="button" class="btn btn-success" disabled title="El trámite debe estar marcado como 'Atendido'">
                    <i class="fas fa-check-double me-2"></i>Finalizar Trámite
                </button>
            @endif
        </div>
    </form>
</div>

<!-- Modal de Confirmación -->
<div class="modal fade" id="modalConfirmarFinalizacion" tabindex="-1" aria-labelledby="modalConfirmarFinalizacionLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title" id="modalConfirmarFinalizacionLabel">
                    <i class="fas fa-check-circle me-2"></i>Confirmar Finalización
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body">
                <div class="alert alert-warning">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    <strong>¿Está seguro de finalizar este trámite?</strong>
                </div>
                
                <div class="mb-3">
                    <strong>Trámite:</strong> <span id="modal-tramite-numero"></span><br>
                    <strong>Solicitante:</strong> <span id="modal-solicitante"></span><br>
                    <strong>Tipo de Finalización:</strong> <span id="modal-tipo-finalizacion"></span>
                </div>
                
                <p class="mb-0">
                    Una vez finalizado, el trámite no podrá ser modificado y se enviará una notificación al solicitante.
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="fas fa-times me-2"></i>Cancelar
                </button>
                <button type="button" class="btn btn-success" id="confirmarFinalizacion">
                    <i class="fas fa-check-double me-2"></i>Confirmar Finalización
                </button>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('form');
    const tipoFinalizacion = document.getElementById('tipo_finalizacion');
    const comentarios = document.getElementById('comentarios_finalizacion');
    const modal = document.getElementById('modalConfirmarFinalizacion');
    const confirmarBtn = document.getElementById('confirmarFinalizacion');
    
    // Actualizar modal con información del trámite
    const modalTramiteNumero = document.getElementById('modal-tramite-numero');
    const modalSolicitante = document.getElementById('modal-solicitante');
    const modalTipoFinalizacion = document.getElementById('modal-tipo-finalizacion');
    
    // Datos del trámite actual
    const tramiteNumero = '{{ $tramite["numero"] }}';
    const tramiteSolicitante = '{{ $tramite["solicitante"] }}';
    
    // Validación del formulario
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        
        // Validar campos requeridos
        if (!tipoFinalizacion.value) {
            alert('Por favor seleccione el tipo de finalización.');
            tipoFinalizacion.focus();
            return false;
        }
        
        if (!comentarios.value || comentarios.value.length < 20) {
            alert('Por favor ingrese un comentario con al menos 20 caracteres.');
            comentarios.focus();
            return false;
        }
        
        // Actualizar modal con información
        modalTramiteNumero.textContent = tramiteNumero;
        modalSolicitante.textContent = tramiteSolicitante;
        modalTipoFinalizacion.textContent = tipoFinalizacion.options[tipoFinalizacion.selectedIndex].text;
        
        // Mostrar modal
        const modalInstance = new bootstrap.Modal(modal);
        modalInstance.show();
    });
    
    // Confirmar finalización
    if (confirmarBtn) {
        confirmarBtn.addEventListener('click', function() {
            // Mostrar loading
            confirmarBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Finalizando...';
            confirmarBtn.disabled = true;
            
            // Enviar formulario
            setTimeout(() => {
                form.submit();
            }, 1000);
        });
    }
    
    // Validación en tiempo real del comentario
    if (comentarios) {
        comentarios.addEventListener('input', function() {
            const contador = this.value.length;
            const minimo = 20;
            const formText = this.nextElementSibling;
            
            if (contador < minimo) {
                formText.textContent = `${contador}/${minimo} caracteres (${minimo - contador} restantes)`;
                formText.className = 'form-text text-danger';
            } else {
                formText.textContent = `${contador} caracteres`;
                formText.className = 'form-text text-success';
            }
        });
    }
    
    // Validación del tipo de finalización
    if (tipoFinalizacion) {
        tipoFinalizacion.addEventListener('change', function() {
            const otroMotivo = this.value === 'otro';
            const label = document.querySelector('label[for="comentarios_finalizacion"]');
            
            if (otroMotivo) {
                label.innerHTML = 'Especifique el motivo de finalización <span class="text-danger">*</span>';
                comentarios.placeholder = 'Especifique detalladamente el motivo de finalización del trámite...';
            } else {
                label.innerHTML = 'Comentarios de Finalización <span class="text-danger">*</span>';
                comentarios.placeholder = 'Describa brevemente el motivo de finalización del trámite. Este comentario será visible en el historial del trámite.';
            }
        });
    }
});
</script>

<style>
/* Estilos específicos para la finalización */
.badge {
    font-size: 0.9em;
}

.modal-body .alert {
    margin-bottom: 1rem;
}

.form-text.text-danger {
    font-weight: 500;
}

.form-text.text-success {
    font-weight: 500;
}

#comentarios_finalizacion {
    transition: border-color 0.3s ease;
}

#comentarios_finalizacion:focus {
    border-color: #22572D;
    box-shadow: 0 0 0 0.2rem rgba(34, 87, 45, 0.25);
}

.btn-success {
    background-color: #22572D;
    border-color: #22572D;
}

.btn-success:hover {
    background-color: #1a4423;
    border-color: #1a4423;
}

.btn-success:disabled {
    background-color: #6c757d;
    border-color: #6c757d;
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .d-flex.justify-content-end {
        flex-direction: column;
        gap: 10px;
    }
    
    .d-flex.justify-content-end .btn {
        width: 100%;
    }
}
</style>
@endsection
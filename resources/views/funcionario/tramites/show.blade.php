@extends('funcionario.layout')

@section('titulo', 'Detalle del Trámite')

@section('contenido')
<div class="container my-4">
    <!-- Título -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3>Detalle del Trámite</h3>
        <a href="{{ route('principal') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left me-2"></i>Volver al Panel
        </a>
    </div>

    @php
        $tramites = [
            1 => [
                'codigo' => 'CN-2024-001',
                'asunto' => 'Licencia de estudios',
                'solicitante' => 'Gutierrez Poma Joshua',
                'fecha' => '05/01/24',
                'estado' => 'Pendiente',
                'descripcion' => 'El estudiante solicita una licencia de estudios por motivos personales para el semestre 2024-II.',
                'fecha_creacion' => '05/01/2024 08:30',
                'ultima_modificacion' => '05/01/2024 08:30',
                'prioridad' => 'Media',
                'categoria' => 'Académico',
                'expediente' => 'EXP-2024-001',
                'observaciones_previas' => []
            ],
            2 => [
                'codigo' => 'RB-2024-002',
                'asunto' => 'Revisión de Borrador de prácticas preprofesionales',
                'solicitante' => 'Lobos Asto Marcos',
                'fecha' => '04/01/24',
                'estado' => 'En Revisión',
                'descripcion' => 'El estudiante presenta el borrador de su informe de prácticas preprofesionales para revisión y aprobación.',
                'fecha_creacion' => '04/01/2024 14:15',
                'ultima_modificacion' => '04/01/2024 16:20',
                'prioridad' => 'Alta',
                'categoria' => 'Prácticas',
                'expediente' => 'EXP-2024-002',
                'observaciones_previas' => [
                    'Documento inicial recibido - 04/01/2024 14:15',
                    'Asignado para revisión - 04/01/2024 16:20'
                ]
            ],
            3 => [
                'codigo' => 'ES-2024-003',
                'asunto' => 'Examen de subsanación',
                'solicitante' => 'Pedro Martínez',
                'fecha' => '02/01/24',
                'estado' => 'Aprobado',
                'descripcion' => 'Solicitud de examen de subsanación para el curso de Matemática Aplicada.',
                'fecha_creacion' => '02/01/2024 10:00',
                'ultima_modificacion' => '03/01/2024 11:30',
                'prioridad' => 'Baja',
                'categoria' => 'Exámenes',
                'expediente' => 'EXP-2024-003',
                'observaciones_previas' => [
                    'Solicitud recibida - 02/01/2024 10:00',
                    'Documentos verificados - 02/01/2024 15:00',
                    'Examen programado - 03/01/2024 09:00',
                    'Examen aprobado - 03/01/2024 11:30'
                ]
            ],
            4 => [
                'codigo' => 'TP-2024-004',
                'asunto' => 'Titulo profesional',
                'solicitante' => 'María González',
                'fecha' => '01/01/24',
                'estado' => 'Pendiente',
                'descripcion' => 'Solicitud de título profesional para la carrera de Ingeniería de Sistemas.',
                'fecha_creacion' => '01/01/2024 10:00',
                'ultima_modificacion' => '03/01/2024 11:30',
                'prioridad' => 'Alta',
                'categoria' => 'Titulos',
                'expediente' => 'TP-2024-004',
                'observaciones_previas' => [
                    'Solicitud recibida - 02/01/2024 10:00',
                    'Documentos verificados - 02/01/2024 15:00',
                ]
            ],
            5 => [
                'codigo' => 'AS-2024-005',
                'asunto' => 'Constancia de apreciación estudiantil',
                'solicitante' => 'Yurivilca Espinoza',
                'fecha' => '11/12/23',
                'estado' => 'En Revisión',
                'descripcion' => 'Solicitud de constancia de apreciación estudiantil para el curso de Programación Avanzada.',
                'fecha_creacion' => '11/12/2023 09:00',
                'ultima_modificacion' => '11/12/2023 10:30',
                'prioridad' => 'Media',
                'categoria' => 'Constancias',
                'expediente' => 'AS-2024-005',
                'observaciones_previas' => []
            ],
            6 => [
                'codigo' => 'CA-2024-006',
                'asunto' => 'Cambio de asesor',
                'solicitante' => 'Alanya Carbajal Yandri',
                'fecha' => '08/12/23',
                'estado' => 'Derivado',
                'descripcion' => 'Solicitud de cambio de asesor para el proyecto de tesis.',
                'fecha_creacion' => '08/12/2023 08:00',
                'ultima_modificacion' => '10/12/2023 09:30',
                'prioridad' => 'Alta',
                'categoria' => 'Tesis',
                'expediente' => 'CA-2024-006',
                'observaciones_previas' => []
            ]
        ];
        $id = (int) $id;
        $tramite = $tramites[$id] ?? $tramites[1];
    @endphp

    <!-- Información Principal del Trámite -->
    <div class="card shadow-sm mb-4">
        <div class="card-header" style="background: var(--verde-oscuro); color: white;">
            <h5 class="mb-0">
                <i class="fas fa-file-alt me-2"></i>
                Información del Trámite
            </h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <p><strong>Código:</strong> <span class="text-primary">{{ $tramite['codigo'] }}</span></p>
                    <p><strong>Asunto:</strong> {{ $tramite['asunto'] }}</p>
                    <p><strong>Solicitante:</strong> {{ $tramite['solicitante'] }}</p>
                    <p><strong>Expediente:</strong> <span class="text-muted">{{ $tramite['expediente'] }}</span></p>
                </div>
                <div class="col-md-6">
                    <p><strong>Fecha de Inicio:</strong> {{ $tramite['fecha'] }}</p>
                    <p><strong>Estado:</strong> 
                        <span class="badge 
                            @if($tramite['estado'] === 'Pendiente') bg-warning
                            @elseif($tramite['estado'] === 'En Revisión') bg-info
                            @elseif($tramite['estado'] === 'Aprobado') bg-success
                            @else bg-secondary
                            @endif">
                            {{ $tramite['estado'] }}
                        </span>
                    </p>
                    <p><strong>Prioridad:</strong> 
                        <span class="badge 
                            @if($tramite['prioridad'] === 'Alta') bg-danger
                            @elseif($tramite['prioridad'] === 'Media') bg-warning
                            @else bg-secondary
                            @endif">
                            {{ $tramite['prioridad'] }}
                        </span>
                    </p>
                    <p><strong>Categoría:</strong> <span class="text-info">{{ $tramite['categoria'] }}</span></p>
                </div>
            </div>
        </div>
    </div>

    <!-- Descripción del Trámite -->
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-light">
            <h6 class="mb-0">
                <i class="fas fa-align-left me-2"></i>
                Descripción
            </h6>
        </div>
        <div class="card-body">
            <p class="mb-0">{{ $tramite['descripcion'] }}</p>
        </div>
    </div>

    <!-- Historial de Observaciones -->
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-light">
            <h6 class="mb-0">
                <i class="fas fa-history me-2"></i>
                Historial de Observaciones
            </h6>
        </div>
        <div class="card-body">
            @if(count($tramite['observaciones_previas']) > 0)
                <div class="timeline">
                    @foreach($tramite['observaciones_previas'] as $observacion)
                        <div class="timeline-item mb-3">
                            <div class="d-flex">
                                <div class="timeline-marker bg-primary rounded-circle me-3" style="width: 12px; height: 12px; margin-top: 6px;"></div>
                                <div class="timeline-content">
                                    <p class="mb-1">{{ $observacion }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-muted mb-0">
                    <i class="fas fa-info-circle me-2"></i>
                    No hay observaciones registradas para este trámite.
                </p>
            @endif
        </div>
    </div>

    <!-- Formulario de Nueva Observación -->
    <div class="card shadow-sm mb-4">
        <div class="card-header" style="background: var(--amarillo-dorado); color: var(--negro);">
            <h6 class="mb-0">
                <i class="fas fa-edit me-2"></i>
                Registrar Nueva Observación
            </h6>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('principal') }}" id="observacionForm">
                @csrf
                <input type="hidden" name="tramite_id" value="{{ $id }}">
                <input type="hidden" name="accion" value="registrar_observacion">
                
                <div class="mb-3">
                    <label for="observacion" class="form-label">
                        <strong>Observación del Funcionario:</strong>
                    </label>
                    <textarea 
                        class="form-control" 
                        id="observacion" 
                        name="observacion" 
                        rows="6" 
                        placeholder="Ingrese sus observaciones aquí..."
                        required></textarea>
                    <div class="form-text">
                        Registre cualquier comentario, nota o acción realizada sobre este trámite.
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="tipo_accion" class="form-label">Tipo de Acción:</label>
                        <select class="form-select" id="tipo_accion" name="tipo_accion">
                            <option value="revision">Revisión</option>
                            <option value="solicitud_info">Solicitud de Información</option>
                            <option value="aprobacion">Aprobación</option>
                            <option value="observacion">Observación General</option>
                            <option value="derivacion">Derivación</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="prioridad_seguimiento" class="form-label">Prioridad de Seguimiento:</label>
                        <select class="form-select" id="prioridad_seguimiento" name="prioridad_seguimiento">
                            <option value="baja">Baja</option>
                            <option value="media" selected>Media</option>
                            <option value="alta">Alta</option>
                            <option value="urgente">Urgente</option>
                        </select>
                    </div>
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn text-black" style="background-color: var(--amarillo-dorado); border-color: var(--negro);">
                        <i class="fas fa-save me-1"></i>
                        Registrar Observación
                    </button>
                    <a href="{{ route('principal') }}" class="btn btn-secondary">
                        <i class="fas fa-times me-1"></i>
                        Cancelar
                    </a>
                </div>
            </form>
        </div>
    </div>

    <!-- Información Adicional -->
    <div class="row">
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-header bg-light">
                    <h6 class="mb-0">
                        <i class="fas fa-clock me-2"></i>
                        Tiempos de Proceso
                    </h6>
                </div>
                <div class="card-body">
                    <p><strong>Fecha de Creación:</strong><br>
                       <small class="text-muted">{{ $tramite['fecha_creacion'] }}</small></p>
                    <p><strong>Última Modificación:</strong><br>
                       <small class="text-muted">{{ $tramite['ultima_modificacion'] }}</small></p>
                    <p><strong>Tiempo Transcurrido:</strong><br>
                       <small class="text-info">
                           @php
                               $fechaCreacion = \Carbon\Carbon::parse($tramite['fecha_creacion']);
                               $ahora = \Carbon\Carbon::now();
                               $diferencia = $fechaCreacion->diffForHumans($ahora);
                           @endphp
                           {{ $diferencia }}
                       </small></p>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-header bg-light">
                    <h6 class="mb-0">
                        <i class="fas fa-cogs me-2"></i>
                        Acciones Disponibles
                    </h6>
                </div>
                <div class="card-body">
                    @if($tramite['estado'] !== 'Aprobado')
                        <a class="btn btn-warning btn-sm mb-2 w-100">
                            <i class="fas fa-share me-1"></i>
                            Derivar Trámite
                        </a>
                        <button class="btn btn-success btn-sm mb-2 w-100" onclick="confirmarFinalizacion()">
                            <i class="fas fa-check me-1"></i>
                            Finalizar Trámite
                        </button>
                    @endif
                    <button class="btn btn-info btn-sm w-100" onclick="generarReporte()">
                        <i class="fas fa-file-pdf me-1"></i>
                        Generar Reporte
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
/* Estilos personalizados para el detalle del trámite */
:root {
    --verde-oscuro: #22572D;
    --amarillo-dorado: #E5C300;
    --negro: #000000;
    --gris-claro: #E0E0E0;
}

.timeline-item {
    position: relative;
}

.timeline-marker {
    flex-shrink: 0;
}

.timeline-content {
    flex: 1;
}

.card {
    border: none;
    transition: box-shadow 0.3s ease;
}

.card:hover {
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
}

.badge {
    font-size: 0.85em;
    padding: 0.5em 0.75em;
}

.form-control:focus {
    border-color: var(--verde-oscuro);
    box-shadow: 0 0 0 0.2rem rgba(34, 87, 45, 0.25);
}

.form-select:focus {
    border-color: var(--verde-oscuro);
    box-shadow: 0 0 0 0.2rem rgba(34, 87, 45, 0.25);
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .container {
        padding: 0 15px;
    }
    
    .d-flex.justify-content-between {
        flex-direction: column;
        gap: 10px;
    }
    
    .d-flex.justify-content-between .btn {
        align-self: stretch;
    }
}

/* Animación para cards */
.card {
    animation: fadeInUp 0.5s ease-out;
}

@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}
</style>

<script>
function confirmarFinalizacion() {
    if (confirm('¿Está seguro de que desea finalizar este trámite?\n\nEsta acción marcará el trámite como completado.')) {
        // Aquí iría la lógica para finalizar el trámite
        window.location.href = "{{ route('tramites.finalizar', $id) }}";
    }
}

function generarReporte() {
    if (confirm('¿Desea generar un reporte PDF de este trámite?')) {
        // Simular generación de reporte
        const btn = event.target.closest('button');
        const originalText = btn.innerHTML;
        btn.innerHTML = '<i class="fas fa-spinner fa-spin me-1"></i>Generando...';
        btn.disabled = true;
        
        setTimeout(() => {
            alert('Reporte generado exitosamente.\n\nSe descargará automáticamente.');
            btn.innerHTML = originalText;
            btn.disabled = false;
        }, 2000);
    }
}

// Auto-resize del textarea
document.addEventListener('DOMContentLoaded', function() {
    const textarea = document.getElementById('observacion');
    
    textarea.addEventListener('input', function() {
        this.style.height = 'auto';
        this.style.height = (this.scrollHeight) + 'px';
    });
    
    // Validación del formulario
    const form = document.getElementById('observacionForm');
    form.addEventListener('submit', function(e) {
        const observacion = document.getElementById('observacion').value.trim();
        
        if (observacion.length < 10) {
            e.preventDefault();
            alert('La observación debe tener al menos 10 caracteres.');
            return false;
        }
        
        if (confirm('¿Está seguro de que desea registrar esta observación?')) {
            // Mostrar mensaje de carga
            const submitBtn = form.querySelector('button[type="submit"]');
            const originalText = submitBtn.innerHTML;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-1"></i>Registrando...';
            submitBtn.disabled = true;
            
            // Simular el procesamiento (puedes quitar esto cuando tengas la ruta real)
            setTimeout(() => {
                // Crear mensaje de éxito
                const alertDiv = document.createElement('div');
                alertDiv.className = 'alert alert-success alert-dismissible fade show';
                alertDiv.role = 'alert';
                alertDiv.innerHTML = `
                    <i class="fas fa-check-circle me-2"></i>
                    Observación registrada exitosamente para el trámite {{ $tramite['codigo'] }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                `;
                
                // Insertar mensaje después del título
                const container = document.querySelector('.container');
                const firstCard = container.querySelector('.card');
                container.insertBefore(alertDiv, firstCard);
                
                // Limpiar formulario
                document.getElementById('observacion').value = '';
                
                // Restaurar botón
                submitBtn.innerHTML = originalText;
                submitBtn.disabled = false;
                
                // Agregar nueva observación al historial
                const historialCard = document.querySelector('.card-body .timeline');
                if (historialCard) {
                    const nuevaObservacion = document.createElement('div');
                    nuevaObservacion.className = 'timeline-item mb-3';
                    const ahora = new Date().toLocaleString('es-ES');
                    nuevaObservacion.innerHTML = `
                        <div class="d-flex">
                            <div class="timeline-marker bg-success rounded-circle me-3" style="width: 12px; height: 12px; margin-top: 6px;"></div>
                            <div class="timeline-content">
                                <p class="mb-1">${observacion} - ${ahora}</p>
                            </div>
                        </div>
                    `;
                    historialCard.insertBefore(nuevaObservacion, historialCard.firstChild);
                }
                
                // Auto-ocultar alerta después de 5 segundos
                setTimeout(() => {
                    alertDiv.style.opacity = '0';
                    setTimeout(() => alertDiv.remove(), 500);
                }, 5000);
                
            }, 1000);
            
            // Prevenir envío real del formulario por ahora
            e.preventDefault();
            return false;
        } else {
            e.preventDefault();
            return false;
        }
    });
});
</script>
@endsection
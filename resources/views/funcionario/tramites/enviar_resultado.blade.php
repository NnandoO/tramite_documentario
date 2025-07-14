@extends('funcionario.layout')

@section('titulo', 'Enviar Resultado del Trámite')

@section('contenido')
<div class="container my-4">
    <!-- Título -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3>Enviar Resultado del Trámite</h3>
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
                'estado' => session('tramite_1_estado', 'Pendiente'),
                'email' => 'gutierrez.joshua@email.com'
            ],
            2 => [
                'codigo' => 'RB-2024-002',
                'asunto' => 'Revisión de Borrador',
                'solicitante' => 'Lobos Asto Marcos',
                'fecha' => '04/01/24',
                'estado' => session('tramite_2_estado', 'En Revisión'),
                'email' => 'lobos.marcos@email.com'
            ],
            3 => [
                'codigo' => 'ES-2024-003',
                'asunto' => 'Examen de Subsanación',
                'solicitante' => 'Pedro Martínez',
                'fecha' => '02/01/24',
                'estado' => session('tramite_3_estado', 'Aprobado'),
                'email' => 'pedro.martinez@email.com'
            ],
            4 => [
                'codigo' => 'TP-2024-004',
                'asunto' => 'Titulo profesional',
                'solicitante' => 'María González',
                'fecha' => '01/01/24',
                'estado' => session('tramite_4_estado', 'Pendiente'),
                'email' => 'maria.gonzalez@email.com'
            ],
            5 => [
                'codigo' => 'AS-2024-005',
                'asunto' => 'Constancia de apreciación estudiantil',
                'solicitante' => 'Yurivilca Espinoza',
                'fecha' => '11/12/23',
                'estado' => session('tramite_5_estado', 'En Revisión'),
                'email' => 'yurivilca.espinoza@email.com'
            ],
            6 => [
                'codigo' => 'CA-2024-006',
                'asunto' => 'Cambio de asesor',
                'solicitante' => 'Alanya Carbajal Yandri',
                'fecha' => '08/12/23',
                'estado' => session('tramite_6_estado', 'Derivado'),
                'email' => 'alanya.carbajal@email.com'
            ]
        ];
        $tramite = $tramites[$id] ?? $tramites[1];
    @endphp

    <!-- Mensajes de confirmación -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-circle me-2"></i>
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Información del Trámite -->
    <div class="card shadow-sm mb-4" style="border-left: 5px solid var(--verde-oscuro);">
        <div class="card-header" style="background: var(--verde-oscuro); color: white;">
            <h5 class="mb-0">
                <i class="fas fa-info-circle me-2"></i>
                Información del Trámite
            </h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <p><strong>Código:</strong> <span class="text-primary">{{ $tramite['codigo'] }}</span></p>
                    <p><strong>Asunto:</strong> {{ $tramite['asunto'] }}</p>
                    <p><strong>Solicitante:</strong> {{ $tramite['solicitante'] }}</p>
                </div>
                <div class="col-md-6">
                    <p><strong>Fecha:</strong> {{ $tramite['fecha'] }}</p>
                    <p><strong>Estado:</strong> 
                        <span class="badge 
                            @if($tramite['estado'] === 'Aprobado') bg-success
                            @elseif($tramite['estado'] === 'Rechazado') bg-danger
                            @elseif($tramite['estado'] === 'Finalizado') bg-success
                            @else bg-info
                            @endif">
                            {{ $tramite['estado'] }}
                        </span>
                    </p>
                    <p><strong>Email del Solicitante:</strong> {{ $tramite['email'] }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Formulario de Envío de Resultado -->
    <div class="card shadow-sm mb-4">
        <div class="card-header" style="background: var(--amarillo-dorado); color: var(--negro);">
            <h5 class="mb-0">
                <i class="fas fa-paper-plane me-2"></i>
                Enviar Resultado al Solicitante
            </h5>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('tramites.procesar_envio_resultado', $id) }}" enctype="multipart/form-data">
                @csrf
                
                <!-- Tipo de Resultado -->
                <div class="mb-3">
                    <label class="form-label"><strong>Tipo de Resultado:</strong></label>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="tipo_resultado" id="aprobado" value="aprobado" checked>
                                <label class="form-check-label text-success" for="aprobado">
                                    <i class="fas fa-check-circle me-1"></i>Aprobado
                                </label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="tipo_resultado" id="rechazado" value="rechazado">
                                <label class="form-check-label text-danger" for="rechazado">
                                    <i class="fas fa-times-circle me-1"></i>Rechazado
                                </label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="tipo_resultado" id="observaciones" value="observaciones">
                                <label class="form-check-label text-warning" for="observaciones">
                                    <i class="fas fa-exclamation-triangle me-1"></i>Con Observaciones
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Mensaje al Solicitante -->
                <div class="mb-3">
                    <label for="mensaje" class="form-label"><strong>Mensaje al Solicitante:</strong></label>
                    <textarea id="mensaje" name="mensaje" class="form-control" rows="6" 
                              placeholder="Redacte el mensaje que recibirá el solicitante..." 
                              required></textarea>
                    <div class="form-text">
                        Este mensaje será enviado por correo electrónico al solicitante junto con los archivos adjuntos.
                    </div>
                </div>

                <!-- Archivos Adjuntos -->
                <div class="mb-3">
                    <label for="archivos" class="form-label"><strong>Adjuntar Archivos:</strong></label>
                    <input type="file" id="archivos" name="archivos[]" class="form-control" multiple accept=".pdf,.doc,.docx,.jpg,.png">
                    <div class="form-text">
                        <i class="fas fa-info-circle me-1"></i>
                        Puede adjuntar múltiples archivos (PDF, DOC, DOCX, JPG, PNG). Máximo 10MB por archivo.
                    </div>
                </div>

                <!-- Plantilla de mensajes predeterminados -->
                <div class="mb-3">
                    <label class="form-label"><strong>Plantillas de Mensaje:</strong></label>
                    <div class="btn-group w-100" role="group">
                        <button type="button" class="btn btn-outline-secondary" onclick="cargarPlantilla('aprobado')">
                            <i class="fas fa-check me-1"></i>Mensaje Aprobado
                        </button>
                        <button type="button" class="btn btn-outline-secondary" onclick="cargarPlantilla('rechazado')">
                            <i class="fas fa-times me-1"></i>Mensaje Rechazado
                        </button>
                        <button type="button" class="btn btn-outline-secondary" onclick="cargarPlantilla('observaciones')">
                            <i class="fas fa-edit me-1"></i>Mensaje con Observaciones
                        </button>
                    </div>
                </div>

                <!-- Opciones de Envío -->
                <div class="mb-3">
                    <div class="card bg-light">
                        <div class="card-body">
                            <h6 class="card-title">Opciones de Envío</h6>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="copia_funcionario" name="copia_funcionario" checked>
                                <label class="form-check-label" for="copia_funcionario">
                                    Enviar copia al funcionario responsable
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="confirmar_recepcion" name="confirmar_recepcion">
                                <label class="form-check-label" for="confirmar_recepcion">
                                    Solicitar confirmación de recepción
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Botones de Acción -->
                <div class="d-flex justify-content-between">
                    <div>
                        <button type="submit" class="btn text-white me-2" style="background-color: var(--verde-oscuro);">
                            <i class="fas fa-paper-plane me-1"></i>
                            Enviar Resultado
                        </button>
                        <button type="button" class="btn btn-outline-primary" onclick="previsualizarMensaje()">
                            <i class="fas fa-eye me-1"></i>
                            Previsualizar
                        </button>
                    </div>
                    <a href="{{ route('principal') }}" class="btn btn-secondary">
                        <i class="fas fa-times me-1"></i>
                        Cancelar
                    </a>
                </div>
            </form>
        </div>
    </div>

    <!-- Historial de Envíos (si existen) -->
    <div class="card shadow-sm">
        <div class="card-header bg-light">
            <h6 class="mb-0">
                <i class="fas fa-history me-2"></i>
                Historial de Envíos
            </h6>
        </div>
        <div class="card-body">
            <div class="list-group list-group-flush">
                <div class="list-group-item border-0 px-0">
                    <small class="text-muted">No hay envíos previos para este trámite</small>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
:root {
    --verde-oscuro: #22572D;
    --amarillo-dorado: #E5C300;
    --negro: #000000;
}

.form-control:focus, .form-select:focus {
    border-color: var(--verde-oscuro);
    box-shadow: 0 0 0 0.2rem rgba(34, 87, 45, 0.25);
}

.form-check-input:checked {
    background-color: var(--verde-oscuro);
    border-color: var(--verde-oscuro);
}

.btn-group .btn {
    flex: 1;
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .btn-group {
        flex-direction: column;
    }
    
    .d-flex.justify-content-between {
        flex-direction: column;
        gap: 10px;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Auto-ocultar las alertas después de 5 segundos
    setTimeout(function() {
        const alerts = document.querySelectorAll('.alert');
        alerts.forEach(function(alert) {
            if (alert.classList.contains('alert-dismissible')) {
                alert.style.opacity = '0';
                setTimeout(() => alert.remove(), 500);
            }
        });
    }, 5000);

    // Actualizar tipo de resultado automáticamente
    const tipoRadios = document.querySelectorAll('input[name="tipo_resultado"]');
    tipoRadios.forEach(radio => {
        radio.addEventListener('change', function() {
            if (this.checked) {
                cargarPlantilla(this.value);
            }
        });
    });

    // Contador de caracteres para el mensaje
    const mensajeTextarea = document.getElementById('mensaje');
    const contadorDiv = document.createElement('div');
    contadorDiv.className = 'form-text text-end';
    contadorDiv.id = 'contador-caracteres';
    mensajeTextarea.parentNode.appendChild(contadorDiv);

    mensajeTextarea.addEventListener('input', function() {
        const caracteres = this.value.length;
        contadorDiv.textContent = `${caracteres} caracteres`;
        
        if (caracteres > 500) {
            contadorDiv.className = 'form-text text-end text-warning';
        } else {
            contadorDiv.className = 'form-text text-end';
        }
    });
});

// Plantillas de mensaje predeterminadas
function cargarPlantilla(tipo) {
    const mensaje = document.getElementById('mensaje');
    const tramiteInfo = '{{ $tramite["codigo"] }} - {{ $tramite["asunto"] }}';
    
    let plantilla = '';
    
    switch(tipo) {
        case 'aprobado':
            plantilla = `Estimado(a) {{ $tramite['solicitante'] }},

Nos complace informarle que su trámite ${tramiteInfo} ha sido APROBADO.

Su solicitud ha sido procesada exitosamente y cumple con todos los requisitos establecidos.

Adjunto encontrará los documentos correspondientes.

Atentamente,
Oficina de Trámites Documentarios`;
            break;
            
        case 'rechazado':
            plantilla = `Estimado(a) {{ $tramite['solicitante'] }},

Lamentamos informarle que su trámite ${tramiteInfo} ha sido RECHAZADO.

Los motivos del rechazo son los siguientes:
- [Especificar motivos]

Para más información, puede contactarse con nuestra oficina.

Atentamente,
Oficina de Trámites Documentarios`;
            break;
            
        case 'observaciones':
            plantilla = `Estimado(a) {{ $tramite['solicitante'] }},

Su trámite ${tramiteInfo} ha sido revisado y presenta las siguientes observaciones:

OBSERVACIONES:
- [Detallar observaciones]

Por favor, subsane las observaciones mencionadas y vuelva a presentar su solicitud.

Atentamente,
Oficina de Trámites Documentarios`;
            break;
    }
    
    mensaje.value = plantilla;
    mensaje.dispatchEvent(new Event('input')); // Trigger contador
}

// Previsualizar mensaje
function previsualizarMensaje() {
    const mensaje = document.getElementById('mensaje').value;
    const tipo = document.querySelector('input[name="tipo_resultado"]:checked').value;
    
    if (!mensaje.trim()) {
        alert('Por favor, escriba un mensaje antes de previsualizar.');
        return;
    }
    
    // Crear modal de previsualización
    const modal = document.createElement('div');
    modal.className = 'modal fade';
    modal.innerHTML = `
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Previsualización del Mensaje</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-info">
                        <strong>Tipo de Resultado:</strong> ${tipo.charAt(0).toUpperCase() + tipo.slice(1)}
                    </div>
                    <div class="border p-3 bg-light">
                        <strong>Para:</strong> {{ $tramite['email'] }}<br>
                        <strong>Asunto:</strong> Resultado de Trámite {{ $tramite['codigo'] }}<br><br>
                        <div style="white-space: pre-line;">${mensaje}</div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    `;
    
    document.body.appendChild(modal);
    const modalInstance = new bootstrap.Modal(modal);
    modalInstance.show();
    
    // Limpiar modal después de cerrar
    modal.addEventListener('hidden.bs.modal', function() {
        document.body.removeChild(modal);
    });
}

// Validación del formulario
document.querySelector('form').addEventListener('submit', function(e) {
    const mensaje = document.getElementById('mensaje').value.trim();
    
    if (!mensaje) {
        e.preventDefault();
        alert('Por favor, escriba un mensaje para el solicitante.');
        return false;
    }
    
    if (mensaje.length < 20) {
        e.preventDefault();
        alert('El mensaje debe tener al menos 20 caracteres.');
        return false;
    }
    
    return confirm('¿Está seguro de que desea enviar este resultado al solicitante?');
});
</script>
@endsection 
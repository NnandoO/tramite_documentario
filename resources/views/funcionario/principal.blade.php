@extends('funcionario.layout')

@section('titulo', 'Panel Principal')

@section('contenido')
<div class="row mb-4">
    <div class="col-12">
        <div class="card header-card text-white" style="background: #22572D;">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <h2 class="card-title mb-1">Panel de Funcionario</h2>
                    <p class="card-text mb-0">Revisión y procesamiento de trámites documentarios</p>
                </div>
                <div>
                    <a href="{{ route('funcionario.bandeja') }}" class="btn btn-light btn-sm">
                        <i class="fas fa-folder"></i> Mis Asignaciones
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

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

<!-- Estadísticas -->
<div class="row mb-4">
    @php
        // Calcular estadísticas dinámicamente con más trámites
        $tramites = [
            ['id' => 1, 'estado' => session('tramite_1_estado', 'Pendiente')],
            ['id' => 2, 'estado' => session('tramite_2_estado', 'En Revisión')],
            ['id' => 3, 'estado' => session('tramite_3_estado', 'Aprobado')],
            ['id' => 4, 'estado' => session('tramite_4_estado', 'Pendiente')],
            ['id' => 5, 'estado' => session('tramite_5_estado', 'En Revisión')],
            ['id' => 6, 'estado' => session('tramite_6_estado', 'Derivado')],
        ];
        
        $pendientes = collect($tramites)->where('estado', 'Pendiente')->count();
        $enProceso = collect($tramites)->whereIn('estado', ['En Revisión', 'Atendido'])->count();
        $completados = collect($tramites)->whereIn('estado', ['Aprobado', 'Finalizado'])->count();
        $derivados = collect($tramites)->where('estado', 'Derivado')->count();
        $total = count($tramites);
    @endphp
    
    <div class="col-md-3">
        <div class="card text-center shadow-sm">
            <div class="card-body">
                <i class="fas fa-folder-open fa-2x text-primary mb-2"></i>
                <h4 class="card-title">{{ $pendientes }}</h4>
                <p class="card-text text-muted">Pendientes</p>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-center shadow-sm">
            <div class="card-body">
                <i class="fas fa-clock fa-2x text-warning mb-2"></i>
                <h4 class="card-title">{{ $enProceso }}</h4>
                <p class="card-text text-muted">En Proceso</p>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-center shadow-sm">
            <div class="card-body">
                <i class="fas fa-check-circle fa-2x text-success mb-2"></i>
                <h4 class="card-title">{{ $completados }}</h4>
                <p class="card-text text-muted">Completados</p>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-center shadow-sm">
            <div class="card-body">
                <i class="fas fa-share fa-2x text-info mb-2"></i>
                <h4 class="card-title">{{ $derivados }}</h4>
                <p class="card-text text-muted">Derivados</p>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <!-- Documentos Asignados -->
    <div class="col-md-8">
        <div class="card shadow-sm">
            <div class="card-header bg-white d-flex justify-content-between align-items-center">
                <h5 class="mb-0">
                    <i class="fas fa-folder text-primary me-2"></i>
                    Documentos Asignados Recientes
                </h5>
                <a href="{{ route('funcionario.bandeja') }}" class="btn btn-outline-primary btn-sm">
                    <i class="fas fa-list me-1"></i>Ver Todos
                </a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="table-light">
                            <tr>
                                <th>Documento</th>
                                <th>Solicitante</th>
                                <th>Fecha Inicio</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $tramitesRecientes = [
                                    [
                                        'id' => 1,
                                        'documento' => 'Licencia de estudios',
                                        'codigo' => 'CN-2024-001',
                                        'solicitante' => 'Gutierrez Poma Joshua',
                                        'fecha_inicio' => '05/01/24',
                                        'estado' => session('tramite_1_estado', 'Pendiente')
                                    ],
                                    [
                                        'id' => 2,
                                        'documento' => 'Revisión de Borrador',
                                        'codigo' => 'RB-2024-002',
                                        'solicitante' => 'Lobos Asto Marcos',
                                        'fecha_inicio' => '04/01/24',
                                        'estado' => session('tramite_2_estado', 'En Revisión')
                                    ],
                                    [
                                        'id' => 3,
                                        'documento' => 'Examen de Subsanación',
                                        'codigo' => 'ES-2024-003',
                                        'solicitante' => 'Pedro Martínez',
                                        'fecha_inicio' => '02/01/24',
                                        'estado' => session('tramite_3_estado', 'Aprobado')
                                    ],
                                    [
                                        'id' => 4,
                                        'documento' => 'Titulo profesional',
                                        'codigo' => 'TF-2024-004',
                                        'solicitante' => 'María González',
                                        'fecha_inicio' => '01/01/24',
                                        'estado' => session('tramite_4_estado', 'Pendiente')
                                    ],
                                    [
                                        'id' => 5,
                                        'documento' => 'Constancia de apreciación estudiantil',
                                        'codigo' => 'AS-2024-005',
                                        'solicitante' => 'Yurivilca Espinoza',
                                        'fecha_inicio' => '11/12/23',
                                        'estado' => session('tramite_5_estado', 'En Revisión')
                                    ],
                                    [
                                        'id' => 6,
                                        'documento' => 'Cambio de asesor',
                                        'codigo' => 'CA-2024-006',
                                        'solicitante' => 'Alanya Carbajal Yandri',
                                        'fecha_inicio' => '08/12/23',
                                        'estado' => session('tramite_6_estado', 'Derivado')
                                    ]
                                ];
                            @endphp

                            @foreach($tramitesRecientes as $tramite)
                                <tr>
                                    <td>
                                        <div>
                                            <strong>{{ $tramite['documento'] }}</strong><br>
                                            <small class="text-muted">{{ $tramite['codigo'] }}</small>
                                        </div>
                                    </td>
                                    <td>{{ $tramite['solicitante'] }}</td>
                                    <td>{{ $tramite['fecha_inicio'] }}</td>
                                    <td>
                                        <span class="badge 
                                            @if($tramite['estado'] === 'Pendiente') bg-warning
                                            @elseif($tramite['estado'] === 'En Revisión') bg-info
                                            @elseif($tramite['estado'] === 'Atendido') bg-primary
                                            @elseif($tramite['estado'] === 'Aprobado') bg-success
                                            @elseif($tramite['estado'] === 'Rechazado') bg-danger
                                            @elseif($tramite['estado'] === 'Derivado') bg-secondary
                                            @elseif($tramite['estado'] === 'Finalizado') bg-success
                                            @elseif($tramite['estado'] === 'Con Observaciones') bg-warning
                                            @elseif($tramite['estado'] === 'Resultado Enviado') bg-dark
                                            @else bg-primary
                                            @endif">
                                            {{ $tramite['estado'] }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <!-- Botón Ver (siempre disponible) -->
                                            <a href="{{ route('tramites.show', $tramite['id']) }}" class="btn btn-info btn-sm" title="Ver Detalle">
                                                <i class="fas fa-eye"></i>
                                            </a>

                                            @if($tramite['estado'] === 'Derivado')
                                                <!-- DERIVADO: Solo ver detalles -->
                                                
                                            @elseif($tramite['estado'] === 'Pendiente' || $tramite['estado'] === 'En Revisión')
                                                <!-- PENDIENTE/EN REVISIÓN: Botón mano para ATENDER -->
                                                <form method="POST" action="{{ route('tramites.marcar_atendido') }}" style="display: inline;" class="form-atender">
                                                    @csrf
                                                    <input type="hidden" name="tramite_id" value="{{ $tramite['id'] }}">
                                                    <button type="submit" class="btn btn-warning btn-sm" title="Marcar como Atendido" onclick="return confirm('¿Marcar este trámite como atendido?')">
                                                        <i class="fas fa-hand-paper"></i>
                                                    </button>
                                                </form>
                                                
                                            @elseif($tramite['estado'] === 'Atendido')
                                                <!-- ATENDIDO: Finalizar + Derivar -->
                                                <a href="{{ route('tramites.finalizar', $tramite['id']) }}" class="btn btn-success btn-sm" title="Finalizar Trámite">
                                                    <i class="fas fa-check-double"></i>
                                                </a>
                                                <a href="{{ route('tramites.derivar', $tramite['id']) }}" class="btn btn-outline-primary btn-sm" title="Derivar Trámite">
                                                    <i class="fas fa-share"></i>
                                                </a>
                                                
                                            @elseif($tramite['estado'] === 'Aprobado' || $tramite['estado'] === 'Rechazado' || $tramite['estado'] === 'Finalizado' || $tramite['estado'] === 'Con Observaciones')
                                                <!-- FINALIZADO: Enviar Resultado -->
                                                <a href="{{ route('tramites.enviar_resultado', $tramite['id']) }}" class="btn btn-success btn-sm" title="Enviar Resultado">
                                                    <i class="fas fa-paper-plane"></i>
                                                </a>
                                                
                                            @elseif($tramite['estado'] === 'Resultado Enviado')
                                                <!-- RESULTADO ENVIADO: Solo ver -->
                                                
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Acciones Rápidas -->
        <div class="card shadow-sm mt-4">
            <div class="card-header bg-white">
                <h5 class="mb-0">
                    <i class="fas fa-bolt text-warning me-2"></i>
                    Acciones Rápidas
                </h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4 mb-2">
                        <a href="{{ route('funcionario.bandeja') }}" class="btn btn-outline-primary w-100">
                            <i class="fas fa-folder me-2"></i>
                            Bandeja de Entrada
                        </a>
                    </div>
                    <div class="col-md-4 mb-2">
                        <button class="btn btn-outline-info w-100" onclick="buscarTramite()">
                            <i class="fas fa-search me-2"></i>
                            Buscar Trámite
                        </button>
                    </div>
                    <div class="col-md-4 mb-2">
                        <button class="btn btn-outline-success w-100" onclick="exportarReporte()">
                            <i class="fas fa-download me-2"></i>
                            Exportar Reporte
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Actividad Reciente -->
    <div class="col-md-4">
        <div class="card shadow-sm">
            <div class="card-header bg-white">
                <h5 class="mb-0">
                    <i class="fas fa-history text-info me-2"></i>
                    Actividad Reciente
                </h5>
            </div>
            <div class="card-body">
                <div class="list-group list-group-flush" id="actividadReciente">
                    <div class="list-group-item border-0 px-0">
                        <small class="text-muted">Hace 2 horas</small>
                        <p class="mb-1">Trámite CN-2024-001 asignado</p>
                    </div>
                    <div class="list-group-item border-0 px-0">
                        <small class="text-muted">Hace 5 horas</small>
                        <p class="mb-1">Documento RB-2024-002 revisado</p>
                    </div>
                    <div class="list-group-item border-0 px-0">
                        <small class="text-muted">Ayer</small>
                        <p class="mb-1">Examen ES-2024-003 aprobado</p>
                    </div>
                    <div class="list-group-item border-0 px-0">
                        <small class="text-muted">Hace 2 días</small>
                        <p class="mb-1">Licencia LF-2024-005 derivada</p>
                    </div>
                </div>
                
                <div class="text-center mt-3">
                    <a href="{{ route('funcionario.bandeja') }}" class="btn btn-outline-info btn-sm">
                        <i class="fas fa-history me-1"></i>Ver Historial Completo
                    </a>
                </div>
            </div>
        </div>

        <!-- Resumen Semanal -->
        <div class="card shadow-sm mt-4">
            <div class="card-header bg-white">
                <h5 class="mb-0">
                    <i class="fas fa-chart-line text-success me-2"></i>
                    Resumen Semanal
                </h5>
            </div>
            <div class="card-body">
                <div class="row text-center">
                    <div class="col-6">
                        <div class="border-end">
                            <h4 class="text-success">{{ $completados + 5 }}</h4>
                            <small class="text-muted">Completados</small>
                        </div>
                    </div>
                    <div class="col-6">
                        <h4 class="text-primary">{{ $pendientes + $enProceso + 3 }}</h4>
                        <small class="text-muted">En Proceso</small>
                    </div>
                </div>
                <hr>
                <div class="progress mb-2" style="height: 10px;">
                    @php
                        $totalSemanal = $completados + $pendientes + $enProceso + 8;
                        $porcentajeCompletado = $totalSemanal > 0 ? (($completados + 5) / $totalSemanal) * 100 : 0;
                    @endphp
                    <div class="progress-bar bg-success" role="progressbar" style="width: {{ $porcentajeCompletado }}%"></div>
                </div>
                <small class="text-muted">{{ round($porcentajeCompletado) }}% de eficiencia semanal</small>
            </div>
        </div>
    </div>
</div>

<script>
// Auto-ocultar las alertas después de 5 segundos
document.addEventListener('DOMContentLoaded', function() {
    setTimeout(function() {
        const alerts = document.querySelectorAll('.alert');
        alerts.forEach(function(alert) {
            if (alert.classList.contains('alert-dismissible')) {
                alert.style.opacity = '0';
                setTimeout(() => alert.remove(), 500);
            }
        });
    }, 5000);
});

function buscarTramite() {
    const termino = prompt('Ingrese el código o nombre del trámite a buscar:');
    if (termino) {
        window.location.href = "{{ route('funcionario.bandeja') }}?buscar=" + encodeURIComponent(termino);
    }
}

function exportarReporte() {
    if (confirm('¿Desea generar un reporte del estado actual de los trámites?')) {
        const btn = event.target;
        const originalText = btn.innerHTML;
        btn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Generando...';
        btn.disabled = true;
        
        setTimeout(() => {
            alert('Reporte generado exitosamente.\n\nSe descargará automáticamente.');
            btn.innerHTML = originalText;
            btn.disabled = false;
        }, 2000);
    }
}

// Función para agregar nueva actividad
function agregarActividad(titulo, tiempo = 'Ahora') {
    const actividadContainer = document.getElementById('actividadReciente');
    if (actividadContainer) {
        const nuevaActividad = document.createElement('div');
        nuevaActividad.className = 'list-group-item border-0 px-0';
        nuevaActividad.innerHTML = `
            <small class="text-muted">${tiempo}</small>
            <p class="mb-1">${titulo}</p>
        `;
        
        actividadContainer.insertBefore(nuevaActividad, actividadContainer.firstChild);
        
        const actividades = actividadContainer.children;
        if (actividades.length > 4) {
            actividadContainer.removeChild(actividades[actividades.length - 1]);
        }
    }
}

// Detectar acciones para actualizar actividad
document.addEventListener('DOMContentLoaded', function() {
    const formsAtender = document.querySelectorAll('.form-atender');
    formsAtender.forEach(form => {
        form.addEventListener('submit', function(e) {
            const row = form.closest('tr');
            const documento = row.querySelector('strong').textContent;
            const codigo = row.querySelector('small').textContent;
            
            // Actualizar actividad
            setTimeout(() => {
                agregarActividad(`${documento} (${codigo}) marcado como atendido`);
            }, 100);
        });
    });
});
</script>

<style>
.btn-group .btn {
    padding: 0.25rem 0.5rem;
    font-size: 0.875rem;
    margin-right: 2px;
}

.btn-group .btn:hover {
    transform: translateY(-1px);
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.badge {
    font-size: 0.85em;
    padding: 0.5em 0.75em;
}

@media (max-width: 768px) {
    .btn-group {
        flex-direction: column;
        gap: 2px;
    }
    
    .btn-group .btn {
        margin-bottom: 2px;
        border-radius: 0.25rem !important;
    }
}
</style>
@endsection
@extends('funcionario.layout')

@section('titulo', 'Mis Asignaciones')

@section('contenido')
<div class="container my-4">
    <!-- Encabezado -->
    <div class="card mb-4" style="background: #22572D; color: white;">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h2 class="mb-1">Bandeja de Asignaciones</h2>
                    <p class="mb-0">Documentos asignados para revisión</p>
                </div>
                <span class="badge bg-light text-dark">
                    <i class="fas fa-file-alt me-1"></i> <span id="contadorDocumentos">6</span> documentos
                </span>
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

    <!-- Filtros rápidos -->
    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <div class="row">
                <div class="col-md-3">
                    <select class="form-select" id="filtroEstadoRapido" onchange="filtrarPorEstado(this.value)">
                        <option value="todos">Todos los estados</option>
                        <option value="Pendiente">Pendientes</option>
                        <option value="En Revisión">En Revisión</option>
                        <option value="Atendido">Atendidos</option>
                        <option value="Aprobado">Aprobados</option>
                        <option value="Rechazado">Rechazados</option>
                        <option value="Derivado">Derivados</option>
                        <option value="Finalizado">Finalizados</option>
                        <option value="Con Observaciones">Con Observaciones</option>
                        <option value="Resultado Enviado">Resultado Enviado</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="fas fa-search"></i>
                        </span>
                        <input type="text" class="form-control" id="busquedaRapida" 
                               placeholder="Buscar por código, documento o solicitante..." 
                               oninput="buscarEnTabla(this.value)">
                    </div>
                </div>
                <div class="col-md-3">
                    <button class="btn btn-outline-secondary w-100" onclick="limpiarFiltros()">
                        <i class="fas fa-refresh me-2"></i>Limpiar Filtros
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabla de Documentos -->
    <div class="card shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover" id="tablaDocumentos">
                    <thead class="table-light">
                        <tr>
                            <th>Documento</th>
                            <th>Solicitante</th>
                            <th>Fecha</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $documentos = [
                                [
                                    'id' => 1,
                                    'documento' => 'Licencia de estudios',
                                    'codigo' => 'CN-2024-001',
                                    'solicitante' => 'Gutierrez Poma Joshua',
                                    'fecha' => '05/01/24',
                                    'estado' => session('tramite_1_estado', 'Pendiente')
                                ],
                                [
                                    'id' => 2,
                                    'documento' => 'Revisión de Borrador',
                                    'codigo' => 'RB-2024-002',
                                    'solicitante' => 'Lobos Asto Marcos',
                                    'fecha' => '04/01/24',
                                    'estado' => session('tramite_2_estado', 'En Revisión')
                                ],
                                [
                                    'id' => 3,
                                    'documento' => 'Examen de Subsanación',
                                    'codigo' => 'ES-2024-003',
                                    'solicitante' => 'Pedro Martínez',
                                    'fecha' => '02/01/24',
                                    'estado' => session('tramite_3_estado', 'Aprobado')
                                ],
                                [
                                    'id' => 4,
                                    'documento' => 'Titulo profesional',
                                    'codigo' => 'TF-2024-004',
                                    'solicitante' => 'María González',
                                    'fecha' => '01/01/24',
                                    'estado' => session('tramite_4_estado', 'Pendiente')
                                ],
                                [
                                    'id' => 5,
                                    'documento' => 'Constancia de apreciación estudiantil',
                                    'codigo' => 'AS-2024-005',
                                    'solicitante' => 'Yurivilca Espinoza',
                                    'fecha' => '11/12/23',
                                    'estado' => session('tramite_5_estado', 'En Revisión')
                                ],
                                [
                                    'id' => 6,
                                    'documento' => 'Cambio de asesor',
                                    'codigo' => 'CA-2024-006',
                                    'solicitante' => 'Alanya Carbajal Yandri',
                                    'fecha' => '08/12/23',
                                    'estado' => session('tramite_6_estado', 'Derivado')
                                ]
                            ];
                        @endphp

                        @foreach($documentos as $doc)
                            <tr data-estado="{{ $doc['estado'] }}" data-searchable="{{ strtolower($doc['codigo'] . ' ' . $doc['documento'] . ' ' . $doc['solicitante']) }}">
                                <td>
                                    <div>
                                        <strong>{{ $doc['documento'] }}</strong>
                                        <div class="text-muted small">{{ $doc['codigo'] }}</div>
                                    </div>
                                </td>
                                <td>{{ $doc['solicitante'] }}</td>
                                <td>{{ $doc['fecha'] }}</td>
                                <td>
                                    <span class="badge badge-estado 
                                        @if($doc['estado'] === 'Pendiente') bg-warning
                                        @elseif($doc['estado'] === 'En Revisión') bg-info
                                        @elseif($doc['estado'] === 'Atendido') bg-primary
                                        @elseif($doc['estado'] === 'Aprobado') bg-success
                                        @elseif($doc['estado'] === 'Rechazado') bg-danger
                                        @elseif($doc['estado'] === 'Derivado') bg-secondary
                                        @elseif($doc['estado'] === 'Finalizado') bg-success
                                        @elseif($doc['estado'] === 'Con Observaciones') bg-warning
                                        @elseif($doc['estado'] === 'Resultado Enviado') bg-dark
                                        @else bg-primary
                                        @endif" id="estado-{{ $doc['id'] }}">
                                        {{ $doc['estado'] }}
                                    </span>
                                </td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <!-- Botón Ver (siempre disponible) -->
                                        <a href="{{ route('tramites.show', $doc['id']) }}" class="btn btn-info btn-sm" title="Ver Detalle">
                                            <i class="fas fa-eye"></i>
                                        </a>

                                        @if($doc['estado'] === 'Derivado')
                                            <!-- DERIVADO: Solo ver detalles -->
                                            
                                        @elseif($doc['estado'] === 'Pendiente' || $doc['estado'] === 'En Revisión')
                                            <!-- PENDIENTE/EN REVISIÓN: Botón mano para ATENDER -->
                                            <form method="POST" action="{{ route('tramites.marcar_atendido') }}" style="display: inline;" class="form-atender">
                                                @csrf
                                                <input type="hidden" name="tramite_id" value="{{ $doc['id'] }}">
                                                <button type="submit" class="btn btn-warning btn-sm" title="Marcar como Atendido" onclick="return confirm('¿Marcar este trámite como atendido?')">
                                                    <i class="fas fa-hand-paper"></i>
                                                </button>
                                            </form>
                                            
                                        @elseif($doc['estado'] === 'Atendido')
                                            <!-- ATENDIDO: Finalizar + Derivar -->
                                            <a href="{{ route('tramites.finalizar', $doc['id']) }}" class="btn btn-success btn-sm" title="Finalizar Trámite">
                                                <i class="fas fa-check-double"></i>
                                            </a>
                                            <a href="{{ route('tramites.derivar', $doc['id']) }}" class="btn btn-outline-primary btn-sm" title="Derivar Trámite">
                                                <i class="fas fa-share"></i>
                                            </a>
                                            
                                        @elseif($doc['estado'] === 'Aprobado' || $doc['estado'] === 'Rechazado' || $doc['estado'] === 'Finalizado' || $doc['estado'] === 'Con Observaciones')
                                            <!-- FINALIZADO: Enviar Resultado -->
                                            <a href="{{ route('tramites.enviar_resultado', $doc['id']) }}" class="btn btn-success btn-sm" title="Enviar Resultado">
                                                <i class="fas fa-paper-plane"></i>
                                            </a>
                                            
                                        @elseif($doc['estado'] === 'Resultado Enviado')
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
        <div class="card-body">
            <div class="row">
                <div class="col-md-4 mb-2">
                    <button class="btn btn-outline-primary w-100" data-bs-toggle="modal" data-bs-target="#buscarTramiteModal">
                        <i class="fas fa-search me-2"></i> Búsqueda Avanzada
                    </button>
                </div>
                <div class="col-md-4 mb-2">
                    <button class="btn btn-outline-success w-100" data-bs-toggle="modal" data-bs-target="#exportarReporteModal">
                        <i class="fas fa-download me-2"></i> Exportar Reporte
                    </button>
                </div>
                <div class="col-md-4 mb-2">
                    <a href="{{ route('principal') }}" class="btn btn-outline-secondary w-100">
                        <i class="fas fa-arrow-left me-2"></i> Volver al Panel
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal para Buscar Trámite -->
<div class="modal fade" id="buscarTramiteModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Búsqueda Avanzada de Trámites</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="codigoTramite" class="form-label">Código del Trámite</label>
                    <input type="text" class="form-control" id="codigoTramite" placeholder="Ej: CN-2024-001">
                </div>
                <div class="mb-3">
                    <label for="nombreSolicitante" class="form-label">Nombre del Solicitante</label>
                    <input type="text" class="form-control" id="nombreSolicitante" placeholder="Ej: María González">
                </div>
                <div class="mb-3">
                    <label for="tipoDocumento" class="form-label">Tipo de Documento</label>
                    <select class="form-select" id="tipoDocumento">
                        <option value="">Todos los tipos</option>
                        <option value="Licencia">Licencias</option>
                        <option value="Certificado">Certificados</option>
                        <option value="Permiso">Permisos</option>
                        <option value="Revisión">Revisiones</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary" id="btnBuscarTramite">Buscar</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal para Exportar Reporte -->
<div class="modal fade" id="exportarReporteModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Exportar Reporte</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label">Formato de Exportación</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="formatoExportacion" id="formatoPDF" checked>
                        <label class="form-check-label" for="formatoPDF">PDF</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="formatoExportacion" id="formatoExcel">
                        <label class="form-check-label" for="formatoExcel">Excel</label>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Filtros para el Reporte</label>
                    <select class="form-select" id="filtroReporte">
                        <option value="todos">Todos los documentos</option>
                        <option value="pendientes">Solo pendientes</option>
                        <option value="atendidos">Solo atendidos</option>
                        <option value="completados">Solo completados</option>
                        <option value="mes_actual">Del mes actual</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="rangoFechas" class="form-label">Rango de Fechas (opcional)</label>
                    <div class="input-group">
                        <input type="date" class="form-control" id="fechaInicio">
                        <span class="input-group-text">a</span>
                        <input type="date" class="form-control" id="fechaFin">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-success" id="btnExportarReporte">Exportar</button>
            </div>
        </div>
    </div>
</div>

<style>
/* Estilos personalizados para la bandeja */
.badge-estado {
    font-size: 0.85em;
    padding: 0.5em 0.75em;
}

.btn-group .btn {
    padding: 0.25rem 0.5rem;
    font-size: 0.875rem;
    margin-right: 2px;
}

.table-hover tbody tr:hover {
    background-color: rgba(34, 87, 45, 0.1);
}

.form-control:focus, .form-select:focus {
    border-color: #22572D;
    box-shadow: 0 0 0 0.2rem rgba(34, 87, 45, 0.25);
}

.btn-outline-primary:hover {
    background-color: #22572D;
    border-color: #22572D;
}

.tabla-fila-oculta {
    display: none;
}

.tabla-fila-resaltada {
    background-color: rgba(229, 195, 0, 0.1);
}

.btn-group .btn:hover {
    transform: translateY(-1px);
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.btn-group .btn-success {
    background-color: #22572D;
    border-color: #22572D;
    font-weight: 600;
}

.btn-group .btn-success:hover {
    background-color: #1a4423;
    border-color: #1a4423;
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

    // Inicializar contador de documentos
    actualizarContador();

    // Manejo del modal Buscar Trámite
    document.getElementById('btnBuscarTramite').addEventListener('click', function() {
        const codigo = document.getElementById('codigoTramite').value.toLowerCase();
        const solicitante = document.getElementById('nombreSolicitante').value.toLowerCase();
        const tipo = document.getElementById('tipoDocumento').value.toLowerCase();
        
        const filas = document.querySelectorAll('#tablaDocumentos tbody tr');
        let encontrados = 0;
        
        filas.forEach(fila => {
            const textoFila = fila.getAttribute('data-searchable') || '';
            const cumpleCodigo = !codigo || textoFila.includes(codigo);
            const cumpleSolicitante = !solicitante || textoFila.includes(solicitante);
            const cumpleTipo = !tipo || textoFila.includes(tipo);
            
            if (cumpleCodigo && cumpleSolicitante && cumpleTipo) {
                fila.style.display = '';
                fila.classList.add('tabla-fila-resaltada');
                encontrados++;
            } else {
                fila.style.display = 'none';
                fila.classList.remove('tabla-fila-resaltada');
            }
        });
        
        if (encontrados === 0) {
            alert('No se encontraron trámites que coincidan con los criterios de búsqueda.');
        } else {
            alert(`Se encontraron ${encontrados} trámite(s) que coinciden con la búsqueda.`);
        }
        
        const modal = bootstrap.Modal.getInstance(document.getElementById('buscarTramiteModal'));
        modal.hide();
        actualizarContador();
    });

    // Manejo del modal Exportar Reporte
    document.getElementById('btnExportarReporte').addEventListener('click', function() {
        const formato = document.querySelector('input[name="formatoExportacion"]:checked').id === 'formatoPDF' ? 'PDF' : 'Excel';
        const filtro = document.getElementById('filtroReporte').value;
        const fechaInicio = document.getElementById('fechaInicio').value;
        const fechaFin = document.getElementById('fechaFin').value;
        
        const btn = this;
        const originalText = btn.innerHTML;
        btn.innerHTML = '<i class="fas fa-spinner fa-spin me-1"></i>Generando...';
        btn.disabled = true;
        
        setTimeout(() => {
            alert(`Reporte exportado exitosamente\n\nFormato: ${formato}\nFiltro: ${filtro}\n${fechaInicio && fechaFin ? `Rango: ${fechaInicio} a ${fechaFin}` : 'Sin rango de fechas'}`);
            
            btn.innerHTML = originalText;
            btn.disabled = false;
            
            const modal = bootstrap.Modal.getInstance(document.getElementById('exportarReporteModal'));
            modal.hide();
        }, 2000);
    });

    // Detectar acciones para actualizar registro y actividad
    const formsAtender = document.querySelectorAll('.form-atender');
    formsAtender.forEach(form => {
        form.addEventListener('submit', function() {
            const row = form.closest('tr');
            const documento = row.querySelector('strong').textContent;
            const codigo = row.querySelector('.text-muted').textContent;
            
            console.log(`[HISTORIAL] ${new Date().toLocaleString()}: ${documento} (${codigo}) - Marcado como atendido por el funcionario`);
        });
    });
});

// Función para filtrar por estado
function filtrarPorEstado(estado) {
    const filas = document.querySelectorAll('#tablaDocumentos tbody tr');
    
    filas.forEach(fila => {
        if (estado === 'todos' || fila.getAttribute('data-estado') === estado) {
            fila.style.display = '';
        } else {
            fila.style.display = 'none';
        }
    });
    
    actualizarContador();
}

// Función para búsqueda rápida en tabla
function buscarEnTabla(termino) {
    const filas = document.querySelectorAll('#tablaDocumentos tbody tr');
    const terminoLower = termino.toLowerCase();
    
    filas.forEach(fila => {
        const textoFila = fila.getAttribute('data-searchable') || '';
        
        if (terminoLower === '' || textoFila.includes(terminoLower)) {
            fila.style.display = '';
        } else {
            fila.style.display = 'none';
        }
    });
    
    actualizarContador();
}

// Función para limpiar filtros
function limpiarFiltros() {
    document.getElementById('filtroEstadoRapido').value = 'todos';
    document.getElementById('busquedaRapida').value = '';
    
    const filas = document.querySelectorAll('#tablaDocumentos tbody tr');
    filas.forEach(fila => {
        fila.style.display = '';
        fila.classList.remove('tabla-fila-resaltada');
    });
    
    actualizarContador();
}

// Función para actualizar contador de documentos visibles
function actualizarContador() {
    const filasVisibles = document.querySelectorAll('#tablaDocumentos tbody tr[style=""], #tablaDocumentos tbody tr:not([style])');
    const contador = document.getElementById('contadorDocumentos');
    if (contador) {
        contador.textContent = filasVisibles.length;
    }
}
</script>
@endsection
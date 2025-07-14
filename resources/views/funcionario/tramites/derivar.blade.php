@extends('funcionario.layout')

@section('titulo', 'Derivar Trámite')

@section('contenido')
<div class="container my-4">
    <!-- Título -->
    <h3 class="mb-4">Derivar Trámite</h3>

    <form method="POST" action="{{ route('tramites.procesar_derivacion', $id) }}">
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
                                'estado' => session('tramite_1_estado', 'Atendido')
                            ],
                            2 => [
                                'numero' => 'RB-2024-002',
                                'solicitante' => 'Lobos Asto Marcos',
                                'asunto' => 'Revisión de Borrador',
                                'estado' => session('tramite_2_estado', 'Atendido')
                            ],
                            3 => [
                                'numero' => 'ES-2024-003',
                                'solicitante' => 'Pedro Martínez',
                                'asunto' => 'Examen de Subsanación',
                                'estado' => session('tramite_3_estado', 'Atendido')
                            ],
                            4 => [
                                'numero' => 'TP-2024-004',
                                'solicitante' => 'María González',
                                'asunto' => 'Titulo profesional',
                                'estado' => session('tramite_4_estado', 'Atendido')
                        ],
                            5 => [
                                'numero' => 'AS-2024-005',
                                'solicitante' => 'Yurivilca Espinoza',
                                'asunto' => 'Constancia de apreciación estudiantil',
                                'estado' => session('tramite_5_estado', 'En Revisión')
                            ],
                            6 => [
                                'numero' => 'CA-2024-006',
                                'solicitante' => 'Alanya Carbajal Yandri',
                                'asunto' => 'Cambio de asesor',
                                'estado' => session('tramite_6_estado', 'Derivado')
                            ]
                        ];
                        $tramite = $tramites[$id] ?? $tramites[1];
                    @endphp
                    
                    <p><strong>Número:</strong> {{ $tramite['numero'] }}</p>
                    <p><strong>Remitente:</strong> {{ $tramite['solicitante'] }}</p>
                </div>
                <div class="col-md-6">
                    <p><strong>Asunto:</strong> {{ $tramite['asunto'] }}</p>
                    <p><strong>Estado:</strong> 
                        <span class="badge 
                            @if($tramite['estado'] === 'Atendido') bg-primary
                            @elseif($tramite['estado'] === 'Pendiente') bg-warning
                            @else bg-info
                            @endif">
                            {{ $tramite['estado'] }}
                        </span>
                    </p>
                </div>
            </div>
        </div>

        <!-- Seleccionar Destinatarios -->
        <div class="card p-3 mb-4 shadow-sm">
            <h5><strong>Seleccionar Destinatarios</strong></h5>

            <!-- Barra de búsqueda MEJORADA -->
            <div class="row mb-3">
                <div class="col-md-6">
                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="fas fa-search"></i>
                        </span>
                        <input type="text" 
                               class="form-control" 
                               id="buscarFuncionario" 
                               placeholder="Buscar funcionario por nombre o cargo..."
                               autocomplete="off">
                    </div>
                    <div class="form-text">
                        <i class="fas fa-info-circle me-1"></i>
                        Puede buscar por nombre completo, apellido o cargo
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="d-flex align-items-center">
                        <span class="me-3">
                            <span id="funcionariosVisibles">0</span> de <span id="totalFuncionarios">0</span> funcionarios
                        </span>
                    </div>
                </div>
                <div class="col-md-2">
                    <button type="button" class="btn btn-outline-secondary btn-sm w-100" id="limpiarBusqueda">
                        <i class="fas fa-times"></i> Limpiar
                    </button>
                </div>
            </div>

            <!-- Filtros adicionales -->
            <div class="row mb-3">
                <div class="col-md-4">
                    <select class="form-select form-select-sm" id="filtroEstado">
                        <option value="todos">Todos los estados</option>
                        <option value="Disponible">Solo disponibles</option>
                        <option value="No Disponible">No disponibles</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <select class="form-select form-select-sm" id="filtroCargo">
                        <option value="todos">Todos los cargos</option>
                        <option value="director">Directores</option>
                        <option value="jefe">Jefes</option>
                        <option value="coordinador">Coordinadores</option>
                        <option value="secretaria">Secretarias</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <button type="button" class="btn btn-outline-info btn-sm w-100" onclick="seleccionarTodos()">
                        <i class="fas fa-check-square"></i> Seleccionar Disponibles
                    </button>
                </div>
            </div>

            @php
                $destinatarios = [
                    ['id' => 1, 'nombre' => 'Miguel Torres', 'cargo' => 'Director de Académicos', 'estado' => 'Disponible'],
                    ['id' => 2, 'nombre' => 'Laura Torres', 'cargo' => 'Subdirectora de Investigación', 'estado' => 'Disponible'],
                    ['id' => 3, 'nombre' => 'Ana Ruiz', 'cargo' => 'Jefe de Recursos Humanos', 'estado' => 'No Disponible'],
                    ['id' => 4, 'nombre' => 'Carmen Vega', 'cargo' => 'Coordinadora de Postgrado', 'estado' => 'Disponible'],
                    ['id' => 5, 'nombre' => 'Roberto Mendoza', 'cargo' => 'Jefe de Admisión', 'estado' => 'Disponible'],
                    ['id' => 6, 'nombre' => 'Patricia Silva', 'cargo' => 'Secretaria Académica', 'estado' => 'Disponible'],
                    ['id' => 7, 'nombre' => 'Carlos Ramírez', 'cargo' => 'Director de Bienestar Estudiantil', 'estado' => 'No Disponible'],
                    ['id' => 8, 'nombre' => 'Elena Morales', 'cargo' => 'Jefe de Biblioteca', 'estado' => 'Disponible'],
                    ['id' => 9, 'nombre' => 'Francisco López', 'cargo' => 'Coordinador de Extensión', 'estado' => 'Disponible'],
                    ['id' => 10, 'nombre' => 'María González', 'cargo' => 'Jefe de Sistemas', 'estado' => 'Disponible'],
                    ['id' => 11, 'nombre' => 'José Herrera', 'cargo' => 'Director de Planificación', 'estado' => 'Disponible'],
                    ['id' => 12, 'nombre' => 'Andrea Vargas', 'cargo' => 'Coordinadora de Calidad', 'estado' => 'No Disponible'],
                    ['id' => 13, 'nombre' => 'Daniel Castro', 'cargo' => 'Jefe de Mantenimiento', 'estado' => 'Disponible'],
                    ['id' => 14, 'nombre' => 'Lucía Fernández', 'cargo' => 'Secretaria de Decanato', 'estado' => 'Disponible'],
                    ['id' => 15, 'nombre' => 'Rodrigo Paredes', 'cargo' => 'Coordinador de Prácticas', 'estado' => 'Disponible'],
                    ['id' => 16, 'nombre' => 'Sofía Jiménez', 'cargo' => 'Jefe de Contabilidad', 'estado' => 'Disponible'],
                    ['id' => 17, 'nombre' => 'Manuel Ortega', 'cargo' => 'Director de Investigación', 'estado' => 'No Disponible'],
                    ['id' => 18, 'nombre' => 'Gabriela Rojas', 'cargo' => 'Coordinadora de Idiomas', 'estado' => 'Disponible'],
                    ['id' => 19, 'nombre' => 'Alejandro Peña', 'cargo' => 'Jefe de Seguridad', 'estado' => 'Disponible'],
                    ['id' => 20, 'nombre' => 'Valentina Cruz', 'cargo' => 'Secretaria General', 'estado' => 'Disponible'],
                ];
            @endphp

            <div class="mt-3" id="listaFuncionarios">
                @foreach ($destinatarios as $d)
                    @php
                        // Determinar el tipo de cargo para el filtro
                        $cargoLower = strtolower($d['cargo']);
                        $cargoTipo = '';
                        
                        if (str_contains($cargoLower, 'director')) {
                            $cargoTipo = 'director';
                        } elseif (str_contains($cargoLower, 'jefe')) {
                            $cargoTipo = 'jefe';
                        } elseif (str_contains($cargoLower, 'coordinador')) {
                            $cargoTipo = 'coordinador';
                        } elseif (str_contains($cargoLower, 'secretaria')) {
                            $cargoTipo = 'secretaria';
                        } else {
                            $cargoTipo = 'otros';
                        }
                    @endphp
                    
                    <div class="card mb-3 p-3 d-flex flex-row align-items-center funcionario-card {{ $d['estado'] === 'No Disponible' ? 'bg-light text-muted' : '' }}"
                         data-nombre="{{ strtolower($d['nombre']) }}" 
                         data-cargo="{{ strtolower($d['cargo']) }}"
                         data-estado="{{ $d['estado'] }}"
                         data-cargo-tipo="{{ $cargoTipo }}">
                        <div class="form-check me-3">
                            <input class="form-check-input" 
                                   type="checkbox" 
                                   name="destinatarios[]" 
                                   value="{{ $d['id'] }}" 
                                   id="destinatario{{ $d['id'] }}"
                                   data-estado="{{ $d['estado'] }}"
                                   {{ $d['estado'] === 'No Disponible' ? 'disabled' : '' }}>
                        </div>
                        <div class="me-auto">
                            <strong class="funcionario-nombre">{{ $d['nombre'] }}</strong><br>
                            <small class="funcionario-cargo">{{ $d['cargo'] }}</small>
                        </div>
                        <span class="badge {{ $d['estado'] === 'Disponible' ? 'bg-success' : 'bg-danger' }} px-3 py-2">
                            {{ $d['estado'] }}
                        </span>
                    </div>
                @endforeach
            </div>

            <!-- Mensaje cuando no hay resultados -->
            <div id="sinResultados" class="alert alert-info text-center" style="display: none;">
                <i class="fas fa-search me-2"></i>
                No se encontraron funcionarios que coincidan con los criterios de búsqueda.
            </div>
        </div>

        <!-- Comentarios adicionales -->
        <div class="card p-3 mb-4 shadow-sm">
            <h5><strong>Comentarios Adicionales</strong></h5>
            <div class="mt-3">
                <textarea class="form-control" name="comentarios" rows="4" 
                          placeholder="Agrega comentarios o instrucciones específicas para el destinatario..."></textarea>
                <div class="form-text">
                    <i class="fas fa-info-circle me-1"></i>
                    Los comentarios serán incluidos en la notificación de derivación
                </div>
            </div>
        </div>

        <!-- Resumen de selección -->
        <div class="card p-3 mb-4 shadow-sm bg-light" id="resumenSeleccion" style="display: none;">
            <h6><strong>Resumen de Derivación</strong></h6>
            <p class="mb-0">
                <span id="contadorSeleccionados">0</span> funcionario(s) seleccionado(s):
                <span id="listadoSeleccionados" class="text-primary"></span>
            </p>
        </div>

        <!-- Botones de acción -->
        <div class="d-flex justify-content-end gap-2">
            <a href="{{ route('principal') }}" class="btn btn-secondary">Cancelar</a>
            <button type="submit" class="btn btn-success" id="btnDerivar">
                <i class="fas fa-share me-1"></i>Derivar Trámite
            </button>
        </div>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const buscarInput = document.getElementById('buscarFuncionario');
    const limpiarBtn = document.getElementById('limpiarBusqueda');
    const funcionarioCards = document.querySelectorAll('.funcionario-card');
    const sinResultados = document.getElementById('sinResultados');
    const funcionariosVisibles = document.getElementById('funcionariosVisibles');
    const totalFuncionarios = document.getElementById('totalFuncionarios');
    const resumenSeleccion = document.getElementById('resumenSeleccion');
    const contadorSeleccionados = document.getElementById('contadorSeleccionados');
    const listadoSeleccionados = document.getElementById('listadoSeleccionados');
    const btnDerivar = document.getElementById('btnDerivar');
    
    // Establecer contador inicial
    totalFuncionarios.textContent = funcionarioCards.length;
    actualizarContador();
    
    // FUNCIÓN DE FILTRADO MEJORADA
    function filtrarFuncionarios() {
        const termino = buscarInput.value.toLowerCase().trim();
        const filtroEstado = document.getElementById('filtroEstado').value;
        const filtroCargo = document.getElementById('filtroCargo').value;
        
        let visibles = 0;
        
        funcionarioCards.forEach(function(card) {
            const nombre = card.getAttribute('data-nombre');
            const cargo = card.getAttribute('data-cargo');
            const estado = card.getAttribute('data-estado');
            const cargoTipo = card.getAttribute('data-cargo-tipo');
            
            // Búsqueda por texto (nombre y cargo)
            const textoCompleto = nombre + ' ' + cargo;
            const cumpleTexto = termino === '' || textoCompleto.includes(termino);
            
            // Filtro por estado
            const cumpleEstado = filtroEstado === 'todos' || estado === filtroEstado;
            
            // Filtro por tipo de cargo - CORREGIDO
            let cumpleCargo = filtroCargo === 'todos';
            if (!cumpleCargo) {
                // Buscar en todo el cargo, no solo en la primera palabra
                cumpleCargo = cargo.toLowerCase().includes(filtroCargo);
            }
            
            if (cumpleTexto && cumpleEstado && cumpleCargo) {
                card.style.display = 'flex';
                visibles++;
            } else {
                card.style.display = 'none';
            }
        });
        
        // Mostrar/ocultar mensaje de sin resultados
        if (visibles === 0 && (termino !== '' || filtroEstado !== 'todos' || filtroCargo !== 'todos')) {
            sinResultados.style.display = 'block';
        } else {
            sinResultados.style.display = 'none';
        }
        
        actualizarContador();
    }

    // Función para actualizar contador
    function actualizarContador() {
        const visibles = Array.from(funcionarioCards).filter(card => 
            card.style.display !== 'none'
        ).length;
        funcionariosVisibles.textContent = visibles;
    }
    
    // Función para actualizar resumen de selección
    function actualizarResumenSeleccion() {
        const checkboxes = document.querySelectorAll('input[name="destinatarios[]"]:checked');
        const count = checkboxes.length;
        
        contadorSeleccionados.textContent = count;
        
        if (count > 0) {
            const nombres = Array.from(checkboxes).map(cb => {
                const card = cb.closest('.funcionario-card');
                return card.querySelector('.funcionario-nombre').textContent;
            });
            
            listadoSeleccionados.textContent = nombres.join(', ');
            resumenSeleccion.style.display = 'block';
            btnDerivar.disabled = false;
        } else {
            resumenSeleccion.style.display = 'none';
            btnDerivar.disabled = true;
        }
    }

    // Event listeners para búsqueda
    buscarInput.addEventListener('input', filtrarFuncionarios);
    
    // Event listeners para filtros
    document.getElementById('filtroEstado').addEventListener('change', filtrarFuncionarios);
    document.getElementById('filtroCargo').addEventListener('change', filtrarFuncionarios);
    
    // Event listener para checkboxes
    document.addEventListener('change', function(e) {
        if (e.target.name === 'destinatarios[]') {
            actualizarResumenSeleccion();
        }
    });
    
    // Limpiar búsqueda
    limpiarBtn.addEventListener('click', function() {
        buscarInput.value = '';
        document.getElementById('filtroEstado').value = 'todos';
        document.getElementById('filtroCargo').value = 'todos';
        
        funcionarioCards.forEach(function(card) {
            card.style.display = 'flex';
        });
        sinResultados.style.display = 'none';
        actualizarContador();
        buscarInput.focus();
    });

    // Limpiar con Escape
    buscarInput.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            limpiarBtn.click();
        }
    });

    // Validación del formulario
    document.querySelector('form').addEventListener('submit', function(e) {
        const checkboxes = document.querySelectorAll('input[name="destinatarios[]"]:checked');
        if (checkboxes.length === 0) {
            e.preventDefault();
            alert('Por favor selecciona al menos un destinatario.');
            return false;
        }
    });
    
    // Inicializar estado del botón
    actualizarResumenSeleccion();
});

// Función para seleccionar todos los disponibles - CORREGIDA
function seleccionarTodos() {
    // Obtener solo los funcionarios visibles (después de aplicar filtros)
    const funcionariosVisibles = Array.from(document.querySelectorAll('.funcionario-card'))
        .filter(card => card.style.display !== 'none');
    
    let seleccionados = 0;
    
    funcionariosVisibles.forEach(card => {
        const checkbox = card.querySelector('input[name="destinatarios[]"]');
        if (!checkbox.disabled && checkbox.getAttribute('data-estado') !== 'No Disponible') {
            checkbox.checked = true;
            seleccionados++;
        }
    });
    
    // Disparar evento de cambio para actualizar el resumen
    const event = new Event('change', { bubbles: true });
    if (seleccionados > 0) {
        document.dispatchEvent(event);
    }
    
    // Actualizar manualmente el resumen
    const checkboxes = document.querySelectorAll('input[name="destinatarios[]"]:checked');
    const count = checkboxes.length;
    
    document.getElementById('contadorSeleccionados').textContent = count;
    
    if (count > 0) {
        const nombres = Array.from(checkboxes).map(cb => {
            const card = cb.closest('.funcionario-card');
            return card.querySelector('.funcionario-nombre').textContent;
        });
        
        document.getElementById('listadoSeleccionados').textContent = nombres.join(', ');
        document.getElementById('resumenSeleccion').style.display = 'block';
        document.getElementById('btnDerivar').disabled = false;
    }
    
    if (seleccionados > 0) {
        alert(`Se seleccionaron ${seleccionados} funcionario(s) disponible(s).`);
    } else {
        alert('No hay funcionarios disponibles para seleccionar con los filtros actuales.');
    }
}
</script>

<style>
/* Estilos mejorados para el filtrado */
.funcionario-card {
    transition: all 0.3s ease;
    border: 2px solid transparent;
}

.funcionario-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(0,0,0,0.1) !important;
}

.funcionario-card:has(input:checked) {
    border-color: #22572D;
    background-color: rgba(34, 87, 45, 0.1) !important;
}

#buscarFuncionario:focus {
    border-color: #22572D;
    box-shadow: 0 0 0 0.2rem rgba(34, 87, 45, 0.25);
}

.input-group-text {
    background-color: #f8f9fa;
    border-color: #ced4da;
}

#sinResultados {
    animation: fadeIn 0.3s ease-in;
}

@keyframes fadeIn {
    from { opacity: 0; transform: translateY(-10px); }
    to { opacity: 1; transform: translateY(0); }
}

#funcionariosVisibles {
    font-weight: bold;
    color: #22572D;
}

#resumenSeleccion {
    border-left: 4px solid #22572D;
    animation: slideIn 0.3s ease;
}

@keyframes slideIn {
    from { opacity: 0; transform: translateX(-20px); }
    to { opacity: 1; transform: translateX(0); }
}

.btn:disabled {
    opacity: 0.6;
    cursor: not-allowed;
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .funcionario-card {
        flex-direction: column;
        align-items: flex-start !important;
    }
    
    .funcionario-card .form-check {
        margin-bottom: 10px;
    }
    
    .funcionario-card .badge {
        align-self: flex-end;
        margin-top: 10px;
    }
}
</style>
@endsection
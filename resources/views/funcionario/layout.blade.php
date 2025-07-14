<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('titulo', 'Sistema de Trámites Documentarios')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --verde-oscuro: #22572D;
            --amarillo-dorado: #E5C300;
            --negro: #000000;
            --gris-claro: #E0E0E0;
        }

        .border-left-primary { border-left: 4px solid var(--amarillo-dorado) !important; }
        .border-left-warning { border-left: 4px solid var(--amarillo-dorado) !important; }
        .border-left-success { border-left: 4px solid var(--verde-oscuro) !important; }
        .border-left-danger { border-left: 4px solid var(--negro) !important; }

        .sidebar { background: var(--verde-oscuro); min-height: 100vh; color: white; }

        .sidebar .nav-link { 
            color: rgba(255,255,255,0.8); 
            transition: all 0.3s ease; 
            margin-bottom: 8px;
            border-radius: 8px;
        }
        .sidebar .nav-link:hover { 
            color: white; 
            background-color: rgba(255,255,255,0.1); 
            transform: translateX(5px);
        }
        .sidebar .nav-link.active { 
            background-color: rgba(255,255,255,0.2); 
            color: white; 
            font-weight: 600;
            box-shadow: 0 2px 8px rgba(0,0,0,0.2);
        }

        .sidebar .nav-link i {
            width: 20px;
            text-align: center;
        }

        .card { margin-bottom: 20px; }
        .stat-card:hover { transform: translateY(-5px); transition: transform 0.3s ease; }

        body { background-color: #f8f9fa; }

        /* Estilos para el perfil del usuario */
        .user-profile {
            border-top: 1px solid rgba(255,255,255,0.1);
            padding-top: 20px;
            margin-top: 30px;
        }

        .user-avatar {
            transition: transform 0.3s ease;
        }

        .user-avatar:hover {
            transform: scale(1.05);
        }

        /* Badge para notificaciones */
        .notification-badge {
            position: absolute;
            top: -2px;
            right: -2px;
            background: var(--amarillo-dorado);
            color: var(--negro);
            border-radius: 50%;
            width: 18px;
            height: 18px;
            font-size: 0.7em;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .sidebar {
                min-height: auto;
                position: static;
            }
            
            .nav-pills .nav-link {
                margin-bottom: 5px;
            }
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-2 sidebar p-3">
                <div class="text-center mb-4">
                    <h5 class="text-white mb-1">
                        <i class="fas fa-file-alt"></i> Trámite Digital
                    </h5>
                    <small class="text-white-50">Sistema de Documentos</small>
                </div>
                
                <!-- Navegación Principal -->
                <nav class="nav nav-pills flex-column">
                    <a class="nav-link {{ request()->routeIs('principal') ? 'active' : '' }}" href="{{ route('principal') }}">
                        <i class="fas fa-tachometer-alt me-2"></i> Panel Principal
                    </a>
                    <a class="nav-link {{ request()->routeIs('funcionario.bandeja') ? 'active' : '' }}" href="{{ route('funcionario.bandeja') }}">
                        <i class="fas fa-folder me-2"></i> Mis Asignaciones
                        @php
                            // Simular contador de documentos pendientes
                            $pendientes = collect([
                                session('tramite_1_estado', 'Pendiente'),
                                session('tramite_2_estado', 'En Revisión'),
                                session('tramite_3_estado', 'Aprobado'),
                                session('tramite_4_estado', 'Pendiente'),
                                session('tramite_5_estado', 'En Revisión'),
                                session('tramite_6_estado', 'Derivado'),
                            ])->filter(function($estado) {
                                return in_array($estado, ['Pendiente', 'En Revisión']);
                            })->count();
                        @endphp
                        @if($pendientes > 0)
                            <span class="notification-badge">{{ $pendientes }}</span>
                        @endif
                    </a>
                    
                    <!-- Divider -->
                    <hr style="border-color: rgba(255,255,255,0.2); margin: 20px 0;">
                </nav>

                <!-- Perfil de Usuario -->
                <div class="user-profile text-center">
                    <div class="card bg-transparent border-light">
                        <div class="card-body text-center p-3">
                            <div class="user-avatar rounded-circle bg-light d-inline-flex align-items-center justify-content-center" 
                                 style="width: 60px; height: 60px;">
                                <i class="fas fa-user text-primary fa-2x"></i>
                            </div>
                            <h6 class="mt-2 mb-1 text-white">Cristian Vargas</h6>
                            <small class="text-white-50">Funcionario</small>
                            
                            <!-- Estado de conexión -->
                            <div class="mt-2">
                                <span class="badge" style="background-color: var(--amarillo-dorado); color: var(--negro);">
                                    <i class="fas fa-circle me-1" style="font-size: 0.7em;"></i>
                                    En línea
                                </span>
                            </div>
                            
                            <!-- Botón de configuración -->
                            <div class="mt-3">
                                <button class="btn btn-outline-light btn-sm" onclick="mostrarConfiguracion()">
                                    <i class="fas fa-cog me-1"></i> Configuración
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Content -->
            <div class="col-md-10 p-4">
                @yield('contenido')
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Scripts del sidebar -->
    <script>
        // Función para filtrar por estado (redirige a bandeja con filtro)
        function filtrarPorEstado(estado) {
            window.location.href = "{{ route('funcionario.bandeja') }}?filtro=" + estado.toLowerCase();
        }

        // Función para búsqueda rápida
        function buscarTramiteRapido() {
            const termino = prompt('Ingrese el código o descripción del trámite:');
            if (termino) {
                window.location.href = "{{ route('funcionario.bandeja') }}?buscar=" + encodeURIComponent(termino);
            }
        }

        // Función para exportar reporte rápido
        function exportarReporteRapido() {
            if (confirm('¿Desea generar un reporte de todos sus trámites asignados?')) {
                alert('Reporte generándose...\nSe descargará automáticamente en unos segundos.');
                // Aquí iría la lógica real de exportación
            }
        }

        // Función para mostrar configuración
        function mostrarConfiguracion() {
            alert('Configuración del usuario:\n\n- Cambiar contraseña\n- Notificaciones\n- Preferencias\n- Cerrar sesión\n\n(Funcionalidad próximamente)');
        }

        // Actualizar notificaciones cada 30 segundos (simular)
        setInterval(function() {
            // Aquí podrías hacer una llamada AJAX para actualizar el contador
            // Por ahora solo es visual
        }, 30000);

        // Añadir tooltips a los elementos del sidebar
        document.addEventListener('DOMContentLoaded', function() {
            // Inicializar tooltips si los hay
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });
        });
    </script>
    
    @yield('scripts')
</body>
</html>
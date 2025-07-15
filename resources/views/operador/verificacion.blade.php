<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Verificación de Expediente</title>
    <link rel="stylesheet" href="{{ asset('css/estilos.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body>
<div class="container">
    <!-- Sidebar -->
    <aside class="sidebar">
        <h2>Mesa de Partes <br><span>Virtual</span></h2>
        <p class="sub">UNCP</p>
        <nav>
            <ul>
                <li><i class="fas fa-file-alt"></i> Registro de Observaciones</li>
                <li class="active"><i class="fas fa-check-circle"></i> Verificación de Expedientes</li>
                <li><i class="fas fa-random"></i> Remisión de expedientes</li>
                <li><i class="fas fa-tasks"></i> Registro de envio automatico</li>
                <li><i class="fas fa-archive"></i> Formulario para flujo</li>
            </ul>
        </nav>
        <div class="user-info">
            <div class="avatar">J</div>
            <div>
                <p><strong>Joel Rojas</strong></p>
                <p>Operador de mesa de Partes</p>
            </div>
        </div>
    </aside>

    <!-- Main content -->
    <main class="main">
        @if(session('success'))
            <div style="background-color: #d4edda; color: #155724; padding: 12px; border-radius: 5px; margin-bottom: 20px;">
                {{ session('success') }}
            </div>
        @endif

        <div class="content-box">
            <h1>VERIFICACIÓN DE EXPEDIENTE</h1>

            <!-- Estado del expediente -->
            <p>
                Estado del expediente:
                <span style="
                    color: {{ 
                        $expediente->estado == 'Rechazado' ? 'red' : 
                        ($expediente->estado == 'Validado' ? 'green' : 'gray') 
                    }};
                    font-weight: bold;
                ">
                    {{ $expediente->estado ?? 'Pendiente' }}
                </span>
            </p>

            <section class="card">
                <h2>VERIFICACIÓN DE REQUISITOS</h2>

                <table class="info-table">
                    <thead>
                        <tr>
                            <th>Expediente</th>
                            <th>Nombre del solicitante</th>
                            <th>Fecha de ingreso</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $expediente->codigo }}</td>
                            <td>{{ $expediente->usuario->name }} {{ $expediente->usuario->last_name }}</td>
                            <td>{{ $expediente->created_at->format('d/m/Y') }}</td>
                        </tr>
                    </tbody>
                </table>

                <table class="req-table">
                    <thead>
                        <tr>
                            <th>Requisito</th>
                            <th>Verificado</th>
                            <th>Acción</th>
                            <th>Visualizar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($requisitos as $req)
                        <tr>
                            <td>{{ $req->nombre_requisito }}</td>
                            <td>
                                <input type="checkbox" {{ $req->estado === 'Cumple' ? 'checked' : '' }} disabled>
                            </td>
                            <td>
                                <a href="{{ route('operador.expediente.requisito.observaciones', [$expediente->id, $req->requisito_id]) }}" class="detalle-btn">Detalle</a>
                            </td>
                            <td>
                                <i class="fas fa-eye"></i>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="acciones">
                    <form method="POST" action="{{ route('operador.expediente.guardar', $expediente->id) }}">
                        @csrf
                        <button class="validar-btn">VALIDAR</button>
                    </form>

                    <form method="POST" action="{{ route('operador.expediente.rechazar', $expediente->id) }}">
                        @csrf
                        <button type="submit" class="rechazar-btn">RECHAZAR Y ARCHIVAR</button>
                    </form>
                </div>
            </section>
        </div>
    </main>
</div>
</body>
</html>

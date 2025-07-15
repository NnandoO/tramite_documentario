<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Observación de Requisito</title>
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
                    <li><i class="fas fa-file-alt"></i> Recepción de Documentos</li>
                    <li class="active"><i class="fas fa-check-circle"></i> Verificación de Expedientes</li>
                    <li><i class="fas fa-random"></i> Derivación de Expedientes</li>
                    <li><i class="fas fa-tasks"></i> Seguimiento de Expedientes</li>
                    <li><i class="fas fa-archive"></i> Archivo General</li>
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
            <div class="content-box">
                <h1>OBSERVACIÓN DE REQUISITO</h1>

                <section class="card">
                    <h2>Requisito: {{ $requisito->nombre }}</h2>

                    <p><strong>Expediente:</strong> {{ $expediente->codigo }}</p>

                    <form method="POST" action="{{ route('operador.expediente.requisito.guardarObservacion', [$expediente->id, $requisito->id]) }}">
                        @csrf

                        <label for="observacion">Observación:</label><br>
                        <textarea name="observacion" id="observacion" rows="5" style="width: 100%;">{{ $pivot->observacion }}</textarea>

                        <div class="acciones">
                            <button type="submit" class="rechazar-btn">Guardar Observación</button>
                            <a href="{{ route('operador.expediente.verificar', $expediente->id) }}" class="validar-btn">Volver</a>
                        </div>
                    </form>
                </section>
            </div>
        </main>
    </div>
</body>
</html>

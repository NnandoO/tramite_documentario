<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');
    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});

// Ruta principal (dashboard del funcionario)
Route::get('/funcionario/principal', function () {
    return view('funcionario.principal');
})->name('principal');

// Bandeja de entrada (Mis Asignaciones)
Route::get('/funcionario/bandeja', function () {
    return view('funcionario.bandeja');
})->name('funcionario.bandeja');

// Mostrar detalle del trámite (Ver)
Route::get('/funcionario/tramites/{id}/ver', function ($id) {
    return view('funcionario.tramites.show', ['id' => $id]);
})->name('tramites.show');

// Derivar trámite (mostrar formulario)
Route::get('/funcionario/tramites/{id}/derivar', function ($id) {
    return view('funcionario.tramites.derivar', ['id' => $id]);
})->name('tramites.derivar');

// Procesar derivación (POST)
Route::post('/funcionario/tramites/{id}/derivar', function ($id) {
    // Validar que se seleccionaron destinatarios
    $destinatarios = request('destinatarios', []);
    $comentarios = request('comentarios');
    
    if (empty($destinatarios)) {
        return redirect()
            ->back()
            ->with('error', 'Debe seleccionar al menos un destinatario.');
    }
    
    // Simular nombres de funcionarios (expandida)
    $funcionarios = [
        1 => 'Miguel Torres',
        2 => 'Laura Torres', 
        3 => 'Ana Ruiz',
        4 => 'Carmen Vega',
        5 => 'Roberto Mendoza',
        6 => 'Patricia Silva',
        7 => 'Carlos Ramírez',
        8 => 'Elena Morales',
        9 => 'Francisco López',
        10 => 'María González',
        11 => 'José Herrera',
        12 => 'Andrea Vargas',
        13 => 'Daniel Castro',
        14 => 'Lucía Fernández',
        15 => 'Rodrigo Paredes',
        16 => 'Sofía Jiménez',
        17 => 'Manuel Ortega',
        18 => 'Gabriela Rojas',
        19 => 'Alejandro Peña',
        20 => 'Valentina Cruz',
    ];
    
    // Obtener nombres de destinatarios seleccionados
    $nombresDestinatarios = [];
    foreach ($destinatarios as $destinatarioId) {
        if (isset($funcionarios[$destinatarioId])) {
            $nombresDestinatarios[] = $funcionarios[$destinatarioId];
        }
    }
    
    // Guardar el estado del trámite en sesión (simular base de datos)
    session(['tramite_' . $id . '_estado' => 'Derivado']);
    
    // Log de trazabilidad para el historial
    $timestamp = now()->format('Y-m-d H:i:s');
    $logKey = 'tramite_' . $id . '_historial';
    $historial = session($logKey, []);
    $historial[] = "[{$timestamp}] Trámite derivado a: " . implode(', ', $nombresDestinatarios);
    if (!empty($comentarios)) {
        $historial[] = "[{$timestamp}] Comentarios: {$comentarios}";
    }
    session([$logKey => $historial]);
    
    // Mensaje de confirmación
    $mensaje = "Trámite derivado exitosamente a: " . implode(', ', $nombresDestinatarios);
    
    if (!empty($comentarios)) {
        $mensaje .= ". Comentarios agregados.";
    }
    
    return redirect()
        ->route('principal')
        ->with('success', $mensaje);
})->name('tramites.procesar_derivacion');

// Marcar trámite como atendido (POST)
Route::post('/funcionario/tramites/marcar-atendido', function () {
    $tramiteId = request('tramite_id');
    
    if (!$tramiteId) {
        return redirect()
            ->back()
            ->with('error', 'ID de trámite no válido.');
    }
    
    // Cambiar estado a "Atendido"
    session(['tramite_' . $tramiteId . '_estado' => 'Atendido']);
    
    // Log de trazabilidad para el historial
    $timestamp = now()->format('Y-m-d H:i:s');
    $logKey = 'tramite_' . $tramiteId . '_historial';
    $historial = session($logKey, []);
    $historial[] = "[{$timestamp}] Trámite marcado como atendido por el funcionario";
    session([$logKey => $historial]);
    
    return redirect()
        ->back()
        ->with('success', "Trámite $tramiteId marcado como atendido exitosamente.");
})->name('tramites.marcar_atendido');

// Procesar acciones de trámites (POST)
Route::post('/funcionario/tramites/procesar-accion', function () {
    $tramiteId = request('tramite_id');
    $accion = request('accion');
    
    if (!$tramiteId || !$accion) {
        return redirect()
            ->back()
            ->with('error', 'Datos incompletos para procesar la acción.');
    }
    
    $mensaje = '';
    
    switch ($accion) {
        case 'aprobar':
            session(['tramite_' . $tramiteId . '_estado' => 'Aprobado']);
            $mensaje = "Trámite $tramiteId aprobado exitosamente.";
            break;
            
        case 'rechazar':
            session(['tramite_' . $tramiteId . '_estado' => 'Rechazado']);
            $mensaje = "Trámite $tramiteId rechazado.";
            break;
            
        case 'finalizar':
            session(['tramite_' . $tramiteId . '_estado' => 'Finalizado']);
            $mensaje = "Trámite $tramiteId finalizado exitosamente.";
            break;
            
        case 'revisar':
            session(['tramite_' . $tramiteId . '_estado' => 'En Revisión']);
            $mensaje = "Trámite $tramiteId marcado como en revisión.";
            break;
            
        case 'atender':
            session(['tramite_' . $tramiteId . '_estado' => 'Atendido']);
            $mensaje = "Trámite $tramiteId marcado como atendido exitosamente.";
            break;
            
        default:
            return redirect()
                ->back()
                ->with('error', 'Acción no válida.');
    }
    
    // Log de trazabilidad
    $timestamp = now()->format('Y-m-d H:i:s');
    $logKey = 'tramite_' . $tramiteId . '_historial';
    $historial = session($logKey, []);
    $historial[] = "[{$timestamp}] Trámite {$accion} por el funcionario";
    session([$logKey => $historial]);
    
    return redirect()
        ->back()
        ->with('success', $mensaje);
})->name('tramites.procesar_accion');

// Ruta para registrar observaciones (POST)
Route::post('/funcionario/tramites/{id}/observacion', function ($id) {
    $observacion = request('observacion');
    $tipoAccion = request('tipo_accion');
    $prioridad = request('prioridad_seguimiento');
    
    if (empty($observacion)) {
        return redirect()
            ->back()
            ->with('error', 'La observación es requerida.');
    }
    
    // Log de trazabilidad
    $timestamp = now()->format('Y-m-d H:i:s');
    $logKey = 'tramite_' . $id . '_historial';
    $historial = session($logKey, []);
    $historial[] = "[{$timestamp}] Observación registrada: {$observacion}";
    session([$logKey => $historial]);
    
    return redirect()
        ->route('tramites.show', $id)
        ->with('success', "Observación registrada exitosamente para el trámite.");
})->name('tramites.registrar_observacion');

// NUEVAS RUTAS PARA ENVÍO DE RESULTADOS

// Mostrar formulario de envío de resultado (GET)
Route::get('/funcionario/tramites/{id}/enviar-resultado', function ($id) {
    return view('funcionario.tramites.enviar_resultado', ['id' => $id]);
})->name('tramites.enviar_resultado');

// Procesar envío de resultado (POST) - CORREGIDO
Route::post('/funcionario/tramites/{id}/enviar-resultado', function ($id) {
    $tipoResultado = request('tipo_resultado');
    $mensaje = request('mensaje');
    $copiaFuncionario = request('copia_funcionario');
    $confirmarRecepcion = request('confirmar_recepcion');
    
    // Validaciones
    if (empty($mensaje)) {
        return redirect()
            ->back()
            ->with('error', 'El mensaje es requerido.');
    }
    
    if (strlen($mensaje) < 20) {
        return redirect()
            ->back()
            ->with('error', 'El mensaje debe tener al menos 20 caracteres.');
    }
    
    // Simular datos del trámite
    $tramites = [
        1 => ['codigo' => 'CN-2024-001', 'solicitante' => 'Gutierrez Poma Joshua'],
        2 => ['codigo' => 'RB-2024-002', 'solicitante' => 'Lobos Asto Marcos'],
        3 => ['codigo' => 'ES-2024-003', 'solicitante' => 'Pedro Martínez'],
        4 => ['codigo' => 'CN-2024-004', 'solicitante' => 'María González'],
    ];
    
    $tramite = $tramites[$id] ?? $tramites[1];
    
    // Procesar archivos adjuntos (simulado)
    $archivosAdjuntos = [];
    if (request()->hasFile('archivos')) {
        foreach (request()->file('archivos') as $archivo) {
            $archivosAdjuntos[] = $archivo->getClientOriginalName();
        }
    }
    
    // CORREGIDO: Actualizar estado a "Resultado Enviado"
    session(['tramite_' . $id . '_estado' => 'Resultado Enviado']);
    
    // Log de trazabilidad
    $timestamp = now()->format('Y-m-d H:i:s');
    $logKey = 'tramite_' . $id . '_historial';
    $historial = session($logKey, []);
    $historial[] = "[{$timestamp}] Resultado enviado al solicitante - Tipo: {$tipoResultado}";
    $historial[] = "[{$timestamp}] Mensaje: " . substr($mensaje, 0, 100) . "...";
    if (!empty($archivosAdjuntos)) {
        $historial[] = "[{$timestamp}] Archivos adjuntos: " . implode(', ', $archivosAdjuntos);
    }
    session([$logKey => $historial]);
    
    // Simular envío de email (aquí iría la lógica real de envío)
    $mensajeConfirmacion = "Resultado enviado exitosamente a {$tramite['solicitante']} para el trámite {$tramite['codigo']}.";
    
    if (!empty($archivosAdjuntos)) {
        $mensajeConfirmacion .= " Se adjuntaron " . count($archivosAdjuntos) . " archivo(s).";
    }
    
    if ($copiaFuncionario) {
        $mensajeConfirmacion .= " Se envió copia al funcionario.";
    }
    
    return redirect()
        ->route('principal')
        ->with('success', $mensajeConfirmacion);
})->name('tramites.procesar_envio_resultado');

// NUEVAS RUTAS PARA FINALIZACIÓN DE TRÁMITES

// Mostrar formulario de finalización (GET)
Route::get('/funcionario/tramites/{id}/finalizar', function ($id) {
    return view('funcionario.tramites.finalizar', ['id' => $id]);
})->name('tramites.finalizar');

// Procesar finalización de trámite (POST) - CORREGIDO
Route::post('/funcionario/tramites/{id}/finalizar', function ($id) {
    $tipoFinalizacion = request('tipo_finalizacion');
    $comentarios = request('comentarios_finalizacion');
    $notificarSolicitante = request('notificar_solicitante');
    $generarReporte = request('generar_reporte');
    
    // Validaciones
    if (empty($tipoFinalizacion)) {
        return redirect()
            ->back()
            ->with('error', 'El tipo de finalización es requerido.');
    }
    
    if (empty($comentarios)) {
        return redirect()
            ->back()
            ->with('error', 'Los comentarios son requeridos.');
    }
    
    if (strlen($comentarios) < 20) {
        return redirect()
            ->back()
            ->with('error', 'Los comentarios deben tener al menos 20 caracteres.');
    }
    
    // CORREGIDO: Verificar que el trámite esté en estado "Atendido"
    $estadoActual = session('tramite_' . $id . '_estado', 'Pendiente');
    if ($estadoActual !== 'Atendido') {
        return redirect()
            ->back()
            ->with('error', 'Solo se pueden finalizar trámites que estén marcados como "Atendido". Estado actual: ' . $estadoActual);
    }
    
    // Simular datos del trámite
    $tramites = [
        1 => ['codigo' => 'CN-2024-001', 'solicitante' => 'Gutierrez Poma Joshua', 'asunto' => 'Licencia de estudios'],
        2 => ['codigo' => 'RB-2024-002', 'solicitante' => 'Lobos Asto Marcos', 'asunto' => 'Revisión de Borrador'],
        3 => ['codigo' => 'ES-2024-003', 'solicitante' => 'Pedro Martínez', 'asunto' => 'Examen de Subsanación'],
        4 => ['codigo' => 'CN-2024-004', 'solicitante' => 'María González', 'asunto' => 'Certificado de Nacimiento'],
    ];
    
    $tramite = $tramites[$id] ?? $tramites[1];
    
    // Procesar archivos adjuntos (simulado)
    $archivosFinales = [];
    if (request()->hasFile('archivos_finales')) {
        foreach (request()->file('archivos_finales') as $archivo) {
            $archivosFinales[] = $archivo->getClientOriginalName();
        }
    }
    
    // CORREGIDO: Actualizar estado según el tipo de finalización
    $nuevoEstado = 'Finalizado';
    switch ($tipoFinalizacion) {
        case 'aprobado':
            $nuevoEstado = 'Aprobado';
            break;
        case 'completado':
            $nuevoEstado = 'Finalizado';
            break;
        case 'resuelto':
            $nuevoEstado = 'Finalizado';
            break;
        case 'entregado':
            $nuevoEstado = 'Finalizado';
            break;
        default:
            $nuevoEstado = 'Finalizado';
            break;
    }
    
    session(['tramite_' . $id . '_estado' => $nuevoEstado]);
    
    // Log de trazabilidad
    $timestamp = now()->format('Y-m-d H:i:s');
    $logKey = 'tramite_' . $id . '_historial';
    $historial = session($logKey, []);
    $historial[] = "[{$timestamp}] Trámite finalizado - Tipo: {$tipoFinalizacion}";
    $historial[] = "[{$timestamp}] Comentarios: {$comentarios}";
    
    if (!empty($archivosFinales)) {
        $historial[] = "[{$timestamp}] Documentos finales adjuntos: " . implode(', ', $archivosFinales);
    }
    
    if ($notificarSolicitante) {
        $historial[] = "[{$timestamp}] Notificación enviada al solicitante";
    }
    
    if ($generarReporte) {
        $historial[] = "[{$timestamp}] Reporte de finalización generado";
    }
    
    session([$logKey => $historial]);
    
    // Mensaje de confirmación
    $mensajeConfirmacion = "Trámite {$tramite['codigo']} finalizado exitosamente.";
    
    if ($notificarSolicitante) {
        $mensajeConfirmacion .= " Se notificó a {$tramite['solicitante']}.";
    }
    
    if (!empty($archivosFinales)) {
        $mensajeConfirmacion .= " Se adjuntaron " . count($archivosFinales) . " documento(s) final(es).";
    }
    
    if ($generarReporte) {
        $mensajeConfirmacion .= " Se generó el reporte de finalización.";
    }
    
    return redirect()
        ->route('principal')
        ->with('success', $mensajeConfirmacion);
})->name('tramites.procesar_finalizacion');

// Finalizar trámite (manteniendo compatibilidad)
Route::get('/funcionario/tramites/{id}/finalizar-directo', function ($id) {
    // Simular finalización directa
    session(['tramite_' . $id . '_estado' => 'Finalizado']);
    
    return redirect()
        ->route('principal')
        ->with('success', "Trámite $id finalizado exitosamente.");
})->name('tramites.finalizar_directo');

// Marcar como atendido (manteniendo compatibilidad)
Route::get('/funcionario/tramites/{id}/atendido', function ($id) {
    return view('funcionario.tramites.atendido', ['id' => $id]);
})->name('tramites.atendido');

require __DIR__.'/auth.php';
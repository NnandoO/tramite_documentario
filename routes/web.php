<?php

use App\Http\Controllers\ExpedienteController;
use App\Http\Controllers\OperadorSolicitudController;
use App\Http\Controllers\SolicitudController;
use App\Http\Controllers\NotificacionController;
use App\Http\Controllers\ExpedienteEntregadoController;
use App\Http\Controllers\AuditEntregaController;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('/acceso-denegado', 'errors.access-denied')->name('access.denied');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Route::get('/expedientes', [ExpedienteController::class, 'index'])
        ->name('expedientes.index');
    Route::get('/expedientes/create', [ExpedienteController::class, 'create'])
        ->name('expedientes.create');
    Route::post('/expedientes', [ExpedienteController::class, 'store'])
        ->name('expedientes.store');
    Route::get('/expedientes/{expediente}', [ExpedienteController::class, 'show'])
        ->name('expedientes.show');
    Route::post('/expedientes/{expediente}/documents', [ExpedienteController::class, 'uploadDocuments'])
        ->name('expedientes.documents.upload');

    Route::get('/expedientes/solicitar', [SolicitudController::class, 'create'])
        ->name('expedientes.solicitar');
    Route::post('/expedientes/solicitar', [SolicitudController::class, 'store'])
        ->name('expedientes.solicitar.store');


    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});

Route::middleware(['auth', 'role:4', 'session.timeout'])->prefix('operador')->group(function () {
    Route::view('/entregas', 'operador.entregas.index')->name('operador.entregas.index');
    Route::view('/repositorio', 'operator.repositorio')->name('operador.repositorio');

    Route::get('/solicitudes', [OperadorSolicitudController::class, 'index'])
        ->name('operador.solicitudes.index');
    Route::get('/solicitudes/{solicitud}', [OperadorSolicitudController::class, 'show'])
        ->name('operador.solicitudes.show');
    Route::get('/solicitudes/{solicitud}/evaluate', [OperadorSolicitudController::class, 'evaluate'])
        ->name('operador.solicitudes.evaluate');

    Route::get('/solicitudes/{id}/entregar', [ExpedienteEntregadoController::class, 'create'])
        ->name('operador.solicitudes.entregar.create');
    Route::post('/solicitudes/{id}/entregar', [ExpedienteEntregadoController::class, 'store'])
        ->name('operador.solicitudes.entregar.store');
    Route::post('/entregados/{entrega}/notificar', [ExpedienteEntregadoController::class, 'notify'])
        ->name('operador.entregados.notificar');
    Route::get('/entregas/{entrega}', [ExpedienteEntregadoController::class, 'show'])
        ->name('operador.entregas.show');

    Route::post('/entregas/{entrega}/notificacion', [NotificacionController::class, 'store'])
        ->name('operador.notificacion.store');

});

Route::middleware(['auth', 'role:4', 'session.timeout'])->get('/archivo-central', function () {
    return redirect()->route('operador.repositorio');
});

Route::middleware(['auth', 'role:product_owner'])->group(function () {
    Route::get('/auditoria/entregas', [\App\Http\Controllers\AuditEntregaController::class, 'index'])
        ->name('auditoria.entregas.index');
    Route::get('/operador/auditoria', [\App\Http\Controllers\AuditEntregaController::class, 'index'])
        ->name('operador.auditoria');
});

Route::post('/notificaciones/{notificacion}/confirmar', [NotificacionController::class, 'confirm'])
    ->name('notificaciones.confirmar')
    ->middleware('auth','role:unidad_notificaciones');

require __DIR__.'/auth.php';

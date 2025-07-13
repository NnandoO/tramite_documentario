<?php

use App\Http\Controllers\ExpedienteController;
use App\Http\Controllers\OperadorSolicitudController;
use App\Http\Controllers\SolicitudController;
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

    Route::get('/operador/solicitudes', [OperadorSolicitudController::class, 'index'])
        ->name('operador.solicitudes.index');
    Route::get('/operador/solicitudes/{solicitud}', [OperadorSolicitudController::class, 'show'])
        ->name('operador.solicitudes.show');
    Route::get('/operador/solicitudes/{solicitud}/evaluate', [OperadorSolicitudController::class, 'evaluate'])
        ->name('operador.solicitudes.evaluate');

    Route::get('/operador/solicitudes/{id}/entregar', [\App\Http\Controllers\ExpedienteEntregadoController::class, 'create'])
        ->name('operador.solicitudes.entregar.create');
    Route::post('/operador/solicitudes/{id}/entregar', [\App\Http\Controllers\ExpedienteEntregadoController::class, 'store'])
        ->name('operador.solicitudes.entregar.store');
    Route::post('/operador/entregados/{entrega}/notificar', [\App\Http\Controllers\ExpedienteEntregadoController::class, 'notify'])
        ->name('operador.entregados.notificar');

    Route::get('/archivo-central', \App\Http\Controllers\ArchivoCentralController::class)
        ->name('archivo.central');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});

Route::middleware(['auth', 'role:product_owner'])->group(function () {
    Route::get('/auditoria/entregas', [\App\Http\Controllers\AuditEntregaController::class, 'index'])
        ->name('auditoria.entregas.index');
});

require __DIR__.'/auth.php';

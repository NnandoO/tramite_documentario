<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;
use App\Http\Controllers\ExpedienteController;
use App\Http\Controllers\SolicitudController;
use App\Http\Controllers\OperadorSolicitudController;

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

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});

require __DIR__.'/auth.php';

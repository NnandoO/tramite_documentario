<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;
use App\Http\Controllers\G1_DocumentosController;
use App\Livewire\CentralFileFilter;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::get('archivo_central', CentralFileFilter::class)
    ->middleware(['auth', 'verified'])
    ->name('archivo.central');

Route::view('carga_documentos', 'carga_documentos')
    ->middleware(['auth', 'verified'])
    ->name('carga.documentos');

Route::view('registro_expediente', 'registro_expediente')
    ->middleware(['auth', 'verified'])
    ->name('registro.expediente');

Route::view('solicitudes_pendientes', 'solicitudes_pendientes')
    ->middleware(['auth', 'verified'])
    ->name('solicitudes.pendientes');

Route::view('formulario_solicitudes', 'formulario_solicitudes')
    ->middleware(['auth', 'verified'])
    ->name('formulario.solicitudes');

Route::view('enviar_expediente', 'enviar_expediente')
    ->middleware(['auth', 'verified'])
    ->name('enviar.expediente');
=======
Route::view('archivo_central', 'archivo_central')
    ->middleware(['auth', 'verified'])
    ->name('archivo.central');

Route::view('carga_documentos', 'carga_documentos')
    ->middleware(['auth', 'verified'])
    ->name('carga.documentos');

Route::view('registro_expediente', 'registro_expediente')
    ->middleware(['auth', 'verified'])
    ->name('registro.expediente');

Route::view('solicitudes_pendientes', 'solicitudes_pendientes')
    ->middleware(['auth', 'verified'])
    ->name('solicitudes.pendientes');

Route::view('formulario_solicitudes', 'formulario_solicitudes')
    ->middleware(['auth', 'verified'])
    ->name('formulario.solicitudes');

Route::get('/carga_documentos', [G1_DocumentosController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('carga.documentos');

Route::post('/carga_documentos/subir', [G1_DocumentosController::class, 'subir'])
    ->name('documentos.subir');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});

require __DIR__.'/auth.php';

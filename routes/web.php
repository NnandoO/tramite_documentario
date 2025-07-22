<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;
use App\Livewire\VerificacionExpediente;
use App\Livewire\RegistroObservaciones;
use App\Livewire\RemisionExpediente;
use App\Livewire\RegistroEnvioAutomatico;
use App\Livewire\FormularioFlujo;
use App\Livewire\CanalizarEnvio;
use App\Livewire\RevisarExpedientesFinalizados;
use App\Livewire\NotificacionesSolicitante;
use App\Livewire\EntregarArchivar;
use App\Livewire\PanelSeguimiento;
use App\Livewire\MisAsignaciones;
use App\Http\Controllers\G1_DocumentosController;
use App\Livewire\CentralFileFilter;
use App\Livewire\DerivarTramite;


Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth', 'verified', 'role:operador'])->group(function () {
    Route::get('/verificacion-expediente', VerificacionExpediente::class)
        ->name('verificacionExpediente');

    Route::get('/registro-observaciones/{expedienteId?}', RegistroObservaciones::class)
        ->name('registroObservaciones');

    Route::get('/remision-expediente/{expedienteId?}', RemisionExpediente::class)
        ->name('remisionExpediente');

    Route::get('/registro-envio-automatico', RegistroEnvioAutomatico::class)
        ->name('registroEnvioAutomatico');

    Route::get('/formulario-flujo', FormularioFlujo::class)
        ->name('formularioFlujo');

    Route::get('/canalizar-envio', CanalizarEnvio::class)
        ->name('canalizarEnvio');

    Route::get('/revisar-expedientes-finalizados', RevisarExpedientesFinalizados::class)
        ->name('revisarExpedientesFinalizados');

    Route::get('/notificaciones-solicitante', NotificacionesSolicitante::class)
        ->name('notificacionesSolicitante');

    Route::get('/entregar-archivar', EntregarArchivar::class)
        ->name('entregarArchivar');

    Route::get('/panel-seguimiento', PanelSeguimiento::class)
        ->name('panelSeguimiento');
});

Route::middleware(['auth', 'verified', 'role:administrador'])->group(function () {
    Route::get('archivo_central', CentralFileFilter::class)
        ->name('archivo.central');

    Route::view('tramite_pendiente', 'Administrador.tramite_pendiente')
        ->name('tramite.pendiente');

    Route::view('tramite_en_proceso', 'Administrador.tramite_en_proceso')
        ->name('tramite.proceso');

    Route::view('tramite_finalizado', 'Administrador.tramite_finalizado')
        ->name('tramite.finalizado');
        
    Route::view('bandeja_entrada', 'Administrador.bandeja_entrada')
        ->name('bandeja.entrada');

    Route::view('repositorio_archivados', 'Administrador.repositorio_archivados')
        ->name('repositorio.archivados');
});

Route::middleware(['auth', 'verified', 'role:funcionario'])->group(function () {
    Route::get('mis_asignaciones', MisAsignaciones::class)
        ->name('mis.asignaciones');

    Route::view('panel_principal', 'Funcionario.panel_principal')
        ->name('panel.principal');

    // bandeja salida
    Route::view('bandeja_salida', 'Funcionario.bandeja_salida')
        ->name('bandeja.salida');

    Route::view('perfil/editar', 'Funcionario.editar-perfil')
        ->name('perfil.editar');

    Route::get('tramites/{tramiteId}/derivar', DerivarTramite::class)
        ->name('derivar.tramite');
});


Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});

require __DIR__.'/auth.php';

<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;
use App\Http\Controllers\TramiteController;

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

require __DIR__.'/auth.php';

// Rutas para tramites de record academico y orden de merito
Route::get('/tramites/record-academico', [TramiteController::class, 'showRecordForm'])->name('tramites.record');
Route::post('/tramites/record-academico', [TramiteController::class, 'submitRecordForm'])->name('tramites.record.enviar');
Route::get('/tramites/constancia-orden-merito', [TramiteController::class, 'showConstOrdForm'])->name('tramites.orden');
Route::post('/tramites/constancia-orden-merito', [TramiteController::class, 'submitConstOrdForm'])->name('tramites.orden.enviar');
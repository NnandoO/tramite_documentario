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



// Rutas limpias por trámite
Route::get('/ampliacion-de-plazo', [TramiteController::class, 'show'])->defaults('id', 1)->name('tramites.ampliacion');
Route::post('/ampliacion-de-plazo', [TramiteController::class, 'store'])->defaults('id', 1);

Route::get('/cambio-de-titulo', [TramiteController::class, 'show'])->defaults('id', 2)->name('tramites.cambio');
Route::post('/cambio-de-titulo', [TramiteController::class, 'store'])->defaults('id', 2);

Route::get('/otros-tramites', [TramiteController::class, 'show'])->defaults('id', 3)->name('tramites.otros');
Route::post('/otros-tramites', [TramiteController::class, 'store'])->defaults('id', 3);
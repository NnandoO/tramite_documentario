<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;
use App\Http\Controllers\TramiteController;
use App\Http\Controllers\TramiteCreateController;

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

    // Rutas de trámites
    Route::resource('tramites', TramiteController::class)->only([
        'index', 'edit', 'update', 'show'
    ]);

    // Rutas para crear nuevos trámites
    Route::get('/tramites/nuevo/{tipo}', [TramiteCreateController::class, 'create'])->name('tramites.nuevo');
    Route::post('/tramites', [TramiteCreateController::class, 'store'])->name('tramites.store');
});

require __DIR__.'/auth.php';

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Operador\ExpedienteController;

Route::prefix('operador')->name('operador.')->group(function () {
    Route::get('/expediente/verificar/{id}', [ExpedienteController::class, 'verificar'])->name('expediente.verificar');
    Route::post('/expediente/verificar/{id}', [ExpedienteController::class, 'guardarVerificacion'])->name('expediente.guardar');
});

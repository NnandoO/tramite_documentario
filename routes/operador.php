<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Operador\ExpedienteController;

Route::prefix('operador')->name('operador.')->group(function () {

    // Verificación del expediente
    Route::get('/expediente/verificar/{id}', [ExpedienteController::class, 'verificar'])
        ->name('expediente.verificar');
    Route::post('/expediente/verificar/{id}', [ExpedienteController::class, 'guardarVerificacion'])
        ->name('expediente.guardar');

    // Observaciones por requisito
    Route::get('/expediente/{expediente_id}/requisito/{requisito_id}/observaciones', [ExpedienteController::class, 'observaciones'])
        ->name('expediente.requisito.observaciones');
    Route::post('/expediente/{expediente_id}/requisito/{requisito_id}/observaciones', [ExpedienteController::class, 'guardarObservacion'])
        ->name('expediente.requisito.guardarObservacion');

    // Rechazar y archivar todo el expediente
    Route::post('/expediente/{id}/rechazar', [ExpedienteController::class, 'rechazarExpediente'])
        ->name('expediente.rechazar');
});

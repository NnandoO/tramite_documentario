<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SolicitudExpedito extends Model
{
    // Campos que se pueden llenar con create() o fill()
    protected $fillable = [
        'sustento',
        'archivos',
    ];

    // Para que Laravel sepa que 'archivos' es un array y se guarde como JSON
    protected $casts = [
        'archivos' => 'array',
    ];
}

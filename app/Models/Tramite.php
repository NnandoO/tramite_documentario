<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tramite extends Model
{
    protected $fillable = [
        'documento',
        'codigo',
        'solicitante',
        'fecha_inicio',
        'estado',
        'funcionario_destinatario',
    ];

    
    
}

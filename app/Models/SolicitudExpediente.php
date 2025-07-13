<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SolicitudExpediente extends Model
{
    use HasFactory;

    public const PENDING = 'pending_evaluation';
    public const APPROVED = 'approved';
    public const REJECTED = 'rejected';

    protected $fillable = [
        'nombre_solicitante',
        'codigo_expediente',
        'tipo_tramite_id',
        'facultad_id',
        'fecha',
        'motivo',
        'status',
        'observaciones',
    ];

    protected $casts = [
        'fecha' => 'date',
    ];
}

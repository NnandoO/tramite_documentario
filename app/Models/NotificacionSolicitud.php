<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\NotificacionHistorial;
use App\Models\ExpedienteEntregado;
use App\Models\SolicitudExpediente;
use App\Models\User;

class NotificacionSolicitud extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'notificacion_solicitudes';

    protected $fillable = [
        'expediente_entregado_id',
        'solicitud_id',
        'operador_id',
        'enviado_at',
        'estado',
        'realizado_at',
    ];

    protected $casts = [
        'enviado_at' => 'datetime',
        'realizado_at' => 'datetime',
    ];

    public function expedienteEntregado(): BelongsTo
    {
        return $this->belongsTo(ExpedienteEntregado::class, 'expediente_entregado_id');
    }

    public function solicitud(): BelongsTo
    {
        return $this->belongsTo(SolicitudExpediente::class, 'solicitud_id');
    }

    public function operador(): BelongsTo
    {
        return $this->belongsTo(User::class, 'operador_id');
    }

    public function historial()
    {
        return $this->hasMany(NotificacionHistorial::class, 'notificacion_id');
    }
}

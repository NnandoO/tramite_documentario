<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\NotificacionSolicitud;

class ExpedienteEntregado extends Model
{
    use HasFactory;

    protected $table = 'expediente_entregado';

    protected $fillable = [
        'expediente_id',
        'solicitud_id',
        'ruta',
        'user_id',
        'visible_para_usuario',
    ];

    protected $casts = [
        'visible_para_usuario' => 'boolean',
    ];

    public function expediente()
    {
        return $this->belongsTo(Expediente::class);
    }

    public function solicitud()
    {
        return $this->belongsTo(SolicitudExpediente::class, 'solicitud_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function notificaciones()
    {
        return $this->hasMany(NotificacionSolicitud::class, 'expediente_entregado_id');
    }
}

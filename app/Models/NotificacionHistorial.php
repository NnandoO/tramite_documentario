<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class NotificacionHistorial extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'notificaciones_historial';

    protected $fillable = [
        'notificacion_id',
        'operador_id',
        'accion',
        'created_at',
    ];

    protected $casts = [
        'created_at' => 'datetime',
    ];

    public function notificacion(): BelongsTo
    {
        return $this->belongsTo(NotificacionSolicitud::class, 'notificacion_id');
    }

    public function operador(): BelongsTo
    {
        return $this->belongsTo(User::class, 'operador_id');
    }
}

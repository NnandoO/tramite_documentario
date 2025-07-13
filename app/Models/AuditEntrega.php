<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AuditEntrega extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'expediente_id',
        'solicitante_id',
        'operador_id',
        'delivered_at',
    ];

    protected $casts = [
        'delivered_at' => 'datetime',
    ];

    public function expediente(): BelongsTo
    {
        return $this->belongsTo(Expediente::class);
    }

    public function solicitante(): BelongsTo
    {
        return $this->belongsTo(User::class, 'solicitante_id');
    }

    public function operador(): BelongsTo
    {
        return $this->belongsTo(User::class, 'operador_id');
    }
}

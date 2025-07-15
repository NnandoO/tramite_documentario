<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tramite extends Model
{
    use HasFactory;

    protected $fillable = [
        'expediente',
        'tipo_tramite',
        'estado',
        'fecha_envio',
        'funcionario',
        'cargo_funcionario',
        'historial',
        'user_id',
        'nuevo_asesor',
        'justificacion',
        'titulo_proyecto',
        'asesor_actual',
        'tipo_no_adeudo',
        'documentos'
    ];

    protected $casts = [
        'historial' => 'array',
        'fecha_envio' => 'datetime',
        'documentos' => 'array'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function historial()
    {
        return $this->hasMany(TramiteHistorial::class);
    }
}

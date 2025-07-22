<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequisitosConstanciaExpeditoProfesional extends Model
{
    use HasFactory;

    protected $table = 'requisitos_constancia_expedito_titulo_profesional';

    protected $fillable = [
        'tramite_type_id',
        'titulo',
        'descripcion',
        'duracion',
        'area',
        'dependencia',
        'requiere_foto',
        'requisitos'
    ];

    protected $casts = [
        'requisitos' => 'array',
        'requiere_foto' => 'boolean'
    ];

    // Relación con TramiteType
    public function tramiteType()
    {
        return $this->belongsTo(TramiteType::class);
    }
}
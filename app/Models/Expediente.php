<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expediente extends Model
{
    use HasFactory;

    protected $fillable = [
        'codigo',
        'solicitante',
        'dni',
        'year',
        'month_id',
        'fecha_ingreso',
        'faculty_id',
        'tramite_type_id',
        'status_id',
        'sumilla',
        'observaciones',
        'medio_envio',
        'fecha_envio',
        'fecha_validacion',
        'tipo_documento',
        'area_procedencia',
        'documento_path',
        'fecha_archivo',
        'observacion_archivo',
        'archivo_cargo'
    ];

    public function facultad()
    {
        return $this->belongsTo(Facultad::class, 'faculty_id');
    }

    public function month()
    {
        return $this->belongsTo(Month::class);
    }

    public function tramiteType()
    {
        return $this->belongsTo(TramiteType::class);
    }

    public function status()
    {
        return $this->belongsTo(Status::class);
    }
}

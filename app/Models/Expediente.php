<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Documento;

/**
 * @property int $id
 * @property string $nombre
 * @property int $dependencia_id
 * @property int $tipo_tramite_id
 * @property int $facultad_id
 * @property \Illuminate\Support\Carbon $fecha_expediente
 */
class Expediente extends Model
{
    use HasFactory;

    protected $fillable = [
        'codigo',
        'nombre',
        'dependencia_id',
        'tipo_tramite_id',
        'facultad_id',
        'fecha_expediente',
        'restringido',
    ];

    protected $casts = [
        'fecha_expediente' => 'date',
        'restringido' => 'boolean',
    ];

    public function dependencia()
    {
        return $this->belongsTo(Dependencia::class);
    }

    public function tramite()
    {
        return $this->belongsTo(Tramite::class, 'tipo_tramite_id');
    }

    public function facultad()
    {
        return $this->belongsTo(Facultad::class);
    }

    public function documentos()
    {
        return $this->hasMany(Documento::class);
    }
}

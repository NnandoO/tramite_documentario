<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SolicitudExpedito extends Model
{
    use HasFactory;

    protected $fillable = [
        'titulo_tramite',
        'sustento',
        'archivos',
    ];

    protected $casts = [
        'archivos' => 'array', // Esto convertirá automáticamente el JSON a array
    ];

    // Accessor para obtener los archivos como array
    public function getArchivosAttribute($value)
    {
        return json_decode($value, true) ?? [];
    }

    // Mutator para guardar los archivos como JSON
    public function setArchivosAttribute($value)
    {
        $this->attributes['archivos'] = is_array($value) ? json_encode($value) : $value;
    }
}
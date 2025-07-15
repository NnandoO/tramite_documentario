<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Requisito extends Model
{
    use HasFactory;

    protected $fillable = ['nombre', 'tipo_tramite', 'obligatorio'];

    public function expedientes()
    {
        return $this->belongsToMany(Expediente::class, 'expediente_requisito')
                    ->withPivot(['estado', 'observacion'])
                    ->withTimestamps();
    }
}

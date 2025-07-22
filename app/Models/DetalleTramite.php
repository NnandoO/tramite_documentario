<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory; // ← Importa el trait
use Illuminate\Database\Eloquent\Model;

class DetalleTramite extends Model
{
    use HasFactory; // ← Ahora existe

    protected $table = 'detalles_tramite';

    protected $fillable = [
        'duracion',
        'area_inicio',
    ];
}

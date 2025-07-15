<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TramiteHistorial extends Model
{
    use HasFactory;

    protected $table = 'tramite_historial';

    protected $fillable = [
        'tramite_id',
        'usuario_id',
        'accion',
        'descripcion'
    ];

    public function tramite()
    {
        return $this->belongsTo(Tramite::class);
    }

    public function usuario()
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }
}

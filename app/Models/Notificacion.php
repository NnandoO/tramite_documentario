<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notificacion extends Model
{
    use HasFactory;

    protected $table = 'notificaciones'; // Asegura que apunta a la tabla correcta

    protected $fillable = [
        'user_id',
        'expediente_id',
        'titulo',
        'mensaje',
        'visto',
        'enviado_at',
    ];

    /**
     * Relación con el usuario que recibe la notificación.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
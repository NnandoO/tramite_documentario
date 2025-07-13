<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Documento extends Model
{
    use HasFactory;

    protected $fillable = [
        'expediente_id',
        'ruta',
        'size',
        'user_id',
        'uploaded_at',
    ];

    protected $casts = [
        'uploaded_at' => 'datetime',
    ];

    public function expediente()
    {
        return $this->belongsTo(Expediente::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

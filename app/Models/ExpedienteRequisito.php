<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ExpedienteRequisito extends Model
{
    use HasFactory;

    protected $table = 'expediente_requisito';

    protected $fillable = ['expediente_id', 'requisito_id', 'estado', 'observacion'];

    public function expediente()
    {
        return $this->belongsTo(Expediente::class);
    }

    public function requisito()
    {
        return $this->belongsTo(Requisito::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Expedientes extends Model
{
    use HasFactory;

    protected $fillable = [
        'codigo',
        'name',
        'dni',
        'year',
        'month_id',
        'faculty_id',
        'tramite_type_id',
        'status_id',
        'sumilla',
        'observaciones',
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

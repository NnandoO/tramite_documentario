<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Expedientes extends Model
{
    protected $fillable = ['name', 'year', 'month', 'faculty_id', 'document_type', 'status'];

    public function facultad()
    {
        return $this->belongsTo(Facultad::class, 'faculty_id');
    }
}

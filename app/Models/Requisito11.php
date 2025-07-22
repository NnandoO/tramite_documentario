<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory; 
use Illuminate\Database\Eloquent\Model;

class Requisito11 extends Model
{
    use HasFactory;

    protected $table = 'requisitos_11';

    protected $fillable = [
        'descripcion',
    ];
}

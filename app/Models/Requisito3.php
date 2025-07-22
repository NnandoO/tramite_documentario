<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory; 
use Illuminate\Database\Eloquent\Model;

class Requisito3 extends Model
{
    use HasFactory;

    protected $table = 'requisitos_3';

    protected $fillable = [
        'descripcion',
    ];
}

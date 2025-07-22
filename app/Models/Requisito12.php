<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory; 
use Illuminate\Database\Eloquent\Model;

class Requisito12 extends Model
{
    use HasFactory;

    protected $table = 'requisitos_12';

    protected $fillable = [
        'descripcion',
    ];
}

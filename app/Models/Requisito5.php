<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory; 
use Illuminate\Database\Eloquent\Model;

class Requisito5 extends Model
{
    use HasFactory;

    protected $table = 'requisitos_5';

    protected $fillable = [
        'descripcion',
    ];
}

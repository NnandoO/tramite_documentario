<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory; 
use Illuminate\Database\Eloquent\Model;

class Requisito8 extends Model
{
    use HasFactory;

    protected $table = 'requisitos_8';

    protected $fillable = [
        'descripcion',
    ];
}

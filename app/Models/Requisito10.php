<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory; 
use Illuminate\Database\Eloquent\Model;

class Requisito10 extends Model
{
    use HasFactory;

    protected $table = 'requisitos_10';

    protected $fillable = [
        'descripcion',
    ];
}

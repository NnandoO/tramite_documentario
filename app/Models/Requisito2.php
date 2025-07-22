<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory; 
use Illuminate\Database\Eloquent\Model;

class Requisito2 extends Model
{
    use HasFactory;

    protected $table = 'requisitos_2';

    protected $fillable = [
        'descripcion',
    ];
}

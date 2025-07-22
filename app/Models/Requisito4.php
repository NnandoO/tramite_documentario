<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory; 
use Illuminate\Database\Eloquent\Model;

class Requisito4 extends Model
{
    use HasFactory;

    protected $table = 'requisitos_4';

    protected $fillable = [
        'descripcion',
    ];
}

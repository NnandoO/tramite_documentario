<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory; 
use Illuminate\Database\Eloquent\Model;

class Requisito1 extends Model
{
    use HasFactory;

    protected $table = 'requisitos_1';

    protected $fillable = [
        'descripcion',
    ];
}

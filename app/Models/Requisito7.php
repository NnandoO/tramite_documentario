<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory; 
use Illuminate\Database\Eloquent\Model;

class Requisito7 extends Model
{
    use HasFactory;

    protected $table = 'requisitos_7';

    protected $fillable = [
        'descripcion',
    ];
}

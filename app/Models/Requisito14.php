<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory; 
use Illuminate\Database\Eloquent\Model;

class Requisito14 extends Model
{
    use HasFactory;

    protected $table = 'requisitos_14';

    protected $fillable = [
        'descripcion',
    ];
}

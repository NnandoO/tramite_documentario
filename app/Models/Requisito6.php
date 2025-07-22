<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory; 
use Illuminate\Database\Eloquent\Model;

class Requisito6 extends Model
{
    use HasFactory;

    protected $table = 'requisitos_6';

    protected $fillable = [
        'descripcion',
    ];
}

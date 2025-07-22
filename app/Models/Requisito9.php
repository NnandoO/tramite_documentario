<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory; 
use Illuminate\Database\Eloquent\Model;

class Requisito9 extends Model
{
    use HasFactory;

    protected $table = 'requisitos_9';

    protected $fillable = [
        'descripcion',
    ];
}

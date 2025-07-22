<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory; 
use Illuminate\Database\Eloquent\Model;

class Requisito13 extends Model
{
    use HasFactory;

    protected $table = 'requisitos_13';

    protected $fillable = [
        'descripcion',
    ];
}

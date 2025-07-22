<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ArchiveRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'expediente_id',
        'processed_at',
    ];

    protected $dates = [
        'processed_at',
    ];

    public function expediente()
    {
        return $this->belongsTo(Expediente::class);
    }
}

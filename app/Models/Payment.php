<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'turn_id',
        'extra_id',
        'status',
        'multas',
        'bonos',
        'total',
        'fecha_pago'
    ];
}

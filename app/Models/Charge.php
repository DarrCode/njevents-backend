<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Charge extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'status',
        'recargos',
        'descuentos',
        'total',
        'fecha_pago'
    ];
}

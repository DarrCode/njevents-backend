<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerRequestExtra extends Model
{
    use HasFactory;

    protected $table = "customer_request_extra";

    protected $fillable = [
        'customer_id',
        'request_extra_id',
    ];

    public $timestamps = false;
}

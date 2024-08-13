<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestExtra extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'extra_type',
        'quantity',
        'entry_time',
        'departure_time',
        'dress_code',
        'status', //aproved
    ];

    public function customers() {
        return $this->belongsToMany(Customer::class);
    }
}

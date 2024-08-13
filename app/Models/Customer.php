<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'status',
        'name_fiscal',
        'name_comercial',
        'nif',
        'email',
        'phone',
        'dress_code',
        'street',
        'apartament',
        'municipality',
        'province',
        'postal_code',
    ];

    public function requestExtras() {
        return $this->belongsToMany(RequestExtra::class);
    }
}




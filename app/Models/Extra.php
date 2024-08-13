<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Extra extends Model
{
    use HasFactory;

    protected $fillable = [
        'extra_type_id',
        'user_id',
        'status',
        'first_name',
        'last_name',
        'birth_day',
        'dni',
        'dni_expiration',
        'phone',
        'genre',
        'street',
        'apartament',
        'municipality',
        'province',
        'postal_code',
        'height',
        'weight',
        'shirt_size',
        'shoe_size',
        'has_vehicle',
        'vehicle',
        'vehicle_capacity',
        'specialities',
        'experience',
        'profile',
        'dni_front',
        'dni_back',
        'social_security_front',
        'social_security_back',
        'license_front',
        'license_back',
        'food_front',
        'food_back',
        'title_hosteleria',
    ];
}

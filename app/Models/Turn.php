<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Turn extends Model
{
    use HasFactory;

    protected $fillable = [
        'extra_id',
        'customer_id',
        'date',
        'entry_time',
        'departure_time',
        'total_hours',
        'status',
        'hourly_rate', //precio x hora € 10
        'total', // total generado €  30
    ];

    public function customer(){
        return $this->belongsTo( Customer::class );
    }

    public function extra(){
        return $this->belongsTo( Extra::class );
    }
}

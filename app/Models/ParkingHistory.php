<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParkingHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'parking_location_id',
        'code',
        'vehicle',
        'amount',
        'check_in',
        'check_out',
        'payment_status',
        'payment_type'
    ];

    public function parking_location()
    {
        return $this->belongsTo(ParkingLocation::class, 'parking_location_id');
    }
}

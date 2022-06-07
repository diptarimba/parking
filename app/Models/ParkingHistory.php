<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParkingHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'parking_location_id', 'ref_id', 'pay_amount', 'start_time', 'end_time'
    ];

    public function parking_location()
    {
        return $this->belongsTo(ParkingLocation::class, 'parking_location_id');
    }
}

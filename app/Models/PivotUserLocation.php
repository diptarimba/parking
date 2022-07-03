<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class PivotUserLocation extends Pivot
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'parking_location_id'
    ];

    public function parking_location()
    {
        return $this->belongsTo(ParkingLocation::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

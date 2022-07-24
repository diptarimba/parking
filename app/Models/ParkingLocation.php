<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParkingLocation extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'description', 'latitude', 'longitude', 'location_code'
    ];

    public function user()
    {
        return $this->belongsToMany(User::class, 'pivot_user_locations',);
    }
}

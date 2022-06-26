<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PivotUserLocation extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'parking_location_id'
    ];
}

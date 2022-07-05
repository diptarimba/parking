<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SidebarMenuLabel extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    public function route_limiter()
    {
        return $this->hasMany(RouteLimiter::class);
    }
}

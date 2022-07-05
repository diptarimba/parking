<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RouteLimiter extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'route',
        'code',
        'limiter'
    ];

    public function user_role()
    {
        return $this->belongsToMany(UserRole::class, 'pivot_user_role_menus');
    }
}

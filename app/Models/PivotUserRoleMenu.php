<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PivotUserRoleMenu extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_role_id',
        'route_limiter_id',
        'is_menu',
        'is_active'
    ];

    public function user_role()
    {
        return $this->belongsTo(UserRole::class, 'user_role_id');
    }

    public function route_limiter()
    {
        return $this->belongsTo(RouteLimiter::class, 'route_limiter_id');
    }
}

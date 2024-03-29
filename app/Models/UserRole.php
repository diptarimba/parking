<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class UserRole extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'is_register'
    ];

    public function route_limiter()
    {
        return $this->belongsToMany(RouteLimiter::class, 'pivot_user_role_menus');
    }

    public function route_limiter_sidebar()
    {
        return $this->belongsToMany(RouteLimiter::class, 'pivot_user_role_menus')->wherePivot('is_active', 1);
    }

    public function pivot()
    {
        return $this->hasMany(PivotUserRoleMenu::class);
    }
}

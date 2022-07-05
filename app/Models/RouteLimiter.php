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
        'sidebar_menu_label_id',
        'limiter'
    ];

    public function user_role()
    {
        return $this->belongsToMany(UserRole::class, 'pivot_user_role_menus');
    }

    public function sidebar_menu_label()
    {
        return $this->belongsTo(SidebarMenuLabel::class, 'sidebar_menu_label_id');
    }

}

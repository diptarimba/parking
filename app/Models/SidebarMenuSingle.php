<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SidebarMenuSingle extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'route',
        'code',
        'sidebar_menu_label_id'
    ];
}

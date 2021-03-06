<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class About extends Model
{
    use HasFactory;

    protected $fillable = [
        'icon_id',
        'title',
        'description'
    ];

    public function icon()
    {
        return $this->belongsTo(Icon::class, 'icon_id');
    }
}

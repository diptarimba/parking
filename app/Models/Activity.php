<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use HasFactory;

    protected $fillable = [
        'zmdi_id',
        'title',
        'description'
    ];

    public function icon()
    {
        return $this->belongsTo(Zmdi::class, 'zmdi_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuarios extends Model
{

    protected $fillable = [
        'name',
        'email',
        'estatus',
        'phone'
    ];

    public function scopeActive($query)
    {
        return $query->where('estatus', '<>', 0);
    }
}

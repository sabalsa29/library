<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categorias extends Model
{
    protected $fillable = [
        'name',
        'description',
        'codigo',
        'estatus'
    ];

    public function scopeActive($query)
    {
        return $query->where('estatus', '<>', 0);
    }
}

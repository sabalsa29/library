<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Books extends Model
{
    protected $fillable = [
        'name',
        'categoria_id',
        'name_autor',
        'codigo',
        'date',
        'estatus'
    ];

    public function scopeDisponibles($query)
    {
        return $query->where('estatus', '<>', 0);
    }

    public function categoria(){

        return $this->belongsTo(Categorias::class,'categoria_id','id');

    }
    public function usuario(){

        return $this->belongsTo(User::class,'usuario_id','id');

    }
}

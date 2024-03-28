<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sucursal extends Model
{
    use HasFactory;
    protected $fillable = ['nombre','direccion','telefono','estado' ];

    //relacion uno a muchos
    public function productos()
    {
        return $this->hasMany('App\Models\Producto');
    }
}

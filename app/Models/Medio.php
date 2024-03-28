<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medio extends Model
{
    use HasFactory;
    protected $fillable = ['nombre','banco','numero','moneda','descripcion','estado'];

    public function compras()
    {
        return $this->hasMany('App\Models\Compra','id','idCompra');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleCompra extends Model
{
    use HasFactory;
    protected $fillable = ['idCompra','idProducto','idProveedor','cantidad','precio','observacion' ];
    public function productos()
    {
        return $this->hasMany('App\Models\Producto','id','idProducto');
    }

    public function compra()
    {
        return $this->belongsTo('App\Models\Compra','id','idCompra');
    }
}

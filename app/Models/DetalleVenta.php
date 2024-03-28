<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleVenta extends Model
{
    use HasFactory;
    protected $fillable = ['idVenta','idProducto','cantidad','precio' ];
    public function productos()
    {
        return $this->hasMany('App\Models\Producto','id','idProducto');
    }

    public function venta()
    {
        return $this->belongsTo('App\Models\Venta','id','idVenta');
    }

    public function medida()
    {
        return $this->belongsTo('App\Models\Medida','id','idMedidas');
    }
}

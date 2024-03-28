<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    use HasFactory;
    protected $fillable = ['idCliente','idUsuario','idMedios','idSucursal','fecha','acuenta','saldo','total','observacion','estado' ];
    public function detalleventas()
    {
        return $this->hasMany('App\Models\DetalleVenta','idVenta','id');
    }
    public function medio()
    {
        return $this->belongsTo('App\Models\Medio','idMedios','id');
    }
    public function vendedor()
    {
        return $this->belongsTo('App\Models\User','idUsuario','id');
    }
    public function cliente()
    {
        return $this->belongsTo('App\Models\Cliente','idCliente','id');
    }
     public function sucursal()
    {
        return $this->belongsTo('App\Models\Sucursal','idSucursal','id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Compra extends Model
{
    use HasFactory;
    protected $fillable = ['idMedios','idUsuario','idSucursal','fecha','comprobante','numero','acuenta','saldo','total','estado','observacion' ];
    public function detallecompras()
    {
        return $this->hasMany('App\Models\DetalleCompra','idCompra','id');
    }
    public function categorias()
    {
        return $this->belongsToMany('App\Models\Categoria')->withPivot('compra_id');
    }
    public function medio()
    {
        return $this->belongsTo('App\Models\Medio','idMedios','id');
    }
    public function vendedor()
    {
        return $this->belongsTo('App\Models\User','idUsuario','id');
    }
}            
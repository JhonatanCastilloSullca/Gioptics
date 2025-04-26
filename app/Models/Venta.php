<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    use HasFactory;
    protected $fillable = ['idCliente','idUsuario','idMedios','idSucursal','fecha','acuenta','saldo','total','observacion','estado','documento_id','nume_doc','sunat' ];
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

    public function documento()
    {
        return $this->belongsTo('App\Models\Documento');
    }

    public function documentosunat()
    {
        return $this->hasOne(DocumentoSunat::class);
    }

    public function venta()
    {
        return $this->belongsTo(Venta::class,'factura_id');
    }
}

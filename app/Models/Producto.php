<?php

namespace App\Models;

use App\Events\ProductoCreate;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $fillable = ['nombre','codigo','stock','precio','precio_compra','estado','proveedor_id','categoria_id','sucursal_id','unidad_id'];
    
    protected $dispatchesEvents = [
            'created' => ProductoCreate::class,
        ];
    
    //Relacion uno a mucho (Inversa)
    public function proveedor()
    {
        return $this->belongsTo('App\Models\Proveedor');
    }
    public function categoria()
    {
        return $this->belongsTo('App\Models\Categoria');
    }
    public function sucursal()
    {
        return $this->belongsTo('App\Models\Sucursal');
    }
    public function unidad()
    {
        return $this->belongsTo('App\Models\Unidad');
    }

    public function detallecompra()
    {
        return $this->belongsTo('App\Models\DetalleCompra');
    }

    public function caracteristicas()
    {
        return $this->belongsToMany('App\Models\Caracteristica')->withPivot('producto_id')->orderByPivot('id','asc');
    }

}
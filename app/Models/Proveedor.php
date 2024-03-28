<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    use HasFactory;
    protected $fillable = ['nombre','tipo_documento','num_documento','direccion','celular','email','num_cuenta','descripcion','estado' ];
    
    public function productos()
    {
        return $this->hasMany('App\Models\Producto');
    }
    

}

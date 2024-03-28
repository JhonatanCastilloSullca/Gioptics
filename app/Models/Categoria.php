<?php

namespace App\Models;

use App\Events\CategoriaCreate;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;
    protected $fillable = ['nombre','descripcion','tipo','estado'];

    protected $dispatchesEvents = [
        'created' => CategoriaCreate::class,
    ];
    
    //relacion uno a muchos
    public function productos()
    {
        return $this->hasMany('App\Models\Producto');
    }

    public function adicionales()
    {
        return $this->belongsToMany('App\Models\Adicional')->withPivot('categoria_id');
    }
    public function compras()
    {
        return $this->belongsToMany('App\Models\Compra')->withPivot('categoria_id');
    }
}

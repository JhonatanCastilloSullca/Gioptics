<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unidad extends Model
{
    use HasFactory;    
    protected $fillable = ['nombre','estado'];

    public $timestamps = false;

    //relacion uno a muchos
    public function productos()
    {
        return $this->hasMany('App\Models\Producto');
    }
}

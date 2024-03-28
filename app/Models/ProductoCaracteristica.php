<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductoCaracteristica extends Model
{
    use HasFactory;
    use HasFactory;
    protected $table='caracteristica_producto';
    protected $fillable = ['caracteristica_id','producto_id'];
    public $timestamps = false;

}

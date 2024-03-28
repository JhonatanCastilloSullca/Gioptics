<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoriaCompra extends Model
{
    use HasFactory;
    protected $table='categoria_compra';
    protected $fillable = ['categoria_id','compra_id'];
    public $timestamps = false;
}

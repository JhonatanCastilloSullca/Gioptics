<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdicionalCategoria extends Model
{
    use HasFactory;
    protected $table='adicional_categoria';
    protected $fillable = ['adicional_id','categoria_id'];
    public $timestamps = false;

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Caja extends Model
{
    use HasFactory;
    protected $fillable = ['descripcion','documento','numero','fecha','monto','tipo','idUsuario','idMedios','idSucursal','estado'];

}



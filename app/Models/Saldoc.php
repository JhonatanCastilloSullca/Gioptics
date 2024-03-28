<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Saldoc extends Model
{
    use HasFactory;
    protected $fillable = ['idUsuario','idMedios','idCompra','idSucursal','fecha','monto','estado'];
}

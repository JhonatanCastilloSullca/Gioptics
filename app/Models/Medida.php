<?php

namespace App\Models;

use App\Events\MedidaCreate;
use App\Events\MedidaUpdate;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medida extends Model
{
    use HasFactory;
    protected $fillable = ['odvle','odvlc','odvleje','odvce','odvcc','odvceje','oivle','oivlc','oivleje','oivce','oivcc','oivceje','dip','add','indicaciones','fecha','idUsuario','idMedida','idCliente','idVenta','idSucursal','estado'];

    protected $dispatchesEvents = [
        'created' => MedidaCreate::class,
        'updated' => MedidaUpdate::class,
    ];
    
}


<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paciente extends Model
{
    use HasFactory;
    protected $fillable = ['nombre','tipo_documento','num_documento','edad','celular','tipo','fecha_nac','email','ocupacion'];
}

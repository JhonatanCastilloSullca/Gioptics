<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Adicional extends Model
{
    use HasFactory;
    protected $fillable = ['nombre','estado' ];
    public $timestamps = false;

    public function caracteristicas()
    {
        return $this->hasMany('App\Models\Caracteristica');
    }
    // Relacion Muchos a Muchos
    public function categorias()
    {
        return $this->belongsToMany('App\Models\Categoria')->withPivot('adicional_id');
    }
}

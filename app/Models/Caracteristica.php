<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Caracteristica extends Model
{
    use HasFactory;

    protected $fillable = ['nombre','estado','adicional_id' ];
    public $timestamps = false;
    public function adicional()
    {
        return $this->belongsTo('App\Models\Adicional');
    }

    public function productos()
    {
        return $this->belongsToMany('App\Models\Producto')->withPivot('caracteristica_id');
    }
}

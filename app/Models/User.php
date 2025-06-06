<?php

namespace App\Models;

use App\Events\UserCreate;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['nombre','apellido','tipo_documento','num_documento','celular','email','rol','usuario','password','idSucursal','estado' ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $dispatchesEvents = [
        'created' => UserCreate::class,
    ];

    public function compras()
    {
        return $this->hasMany('App\Models\Compra','idUsuario','id');
    }

    public function sucursal()
    {
        return $this->belongsTo(Sucursal::class,'idSucursal');
    }
}


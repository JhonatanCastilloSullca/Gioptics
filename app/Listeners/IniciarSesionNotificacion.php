<?php

namespace App\Listeners;

use App\Events\IniciarSesion;
use Illuminate\Auth\Events\Login;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class IniciarSesionNotificacion
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(Login $event)
    {
        broadcast(new IniciarSesion("{$event->user->nombre}  is online",'success'));
    }
}

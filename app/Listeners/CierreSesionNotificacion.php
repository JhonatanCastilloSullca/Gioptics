<?php

namespace App\Listeners;

use App\Events\IniciarSesion;
use Illuminate\Auth\Events\Logout;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class CierreSesionNotificacion
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
    public function handle(Logout $event)
    {
        broadcast(new IniciarSesion("{$event->user->nombre}  is offline",'danger'));
    }
}

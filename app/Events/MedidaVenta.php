<?php

namespace App\Events;

use App\Models\Medida;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use DB;

class MedidaVenta implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $medidas;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($medidas)
    {
        $medidas=DB::table('medidas as m')->join('pacientes as p','m.idPaciente','=','p.id')
        ->select('m.id','p.nombre as paciente','p.num_documento','p.tipo_documento','p.celular','p.email')
        ->where('m.estado','=','Registrado')
        ->orderBy('m.id','desc')
        ->first();

        $this->medidas=$medidas;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        
        return new Channel('medidaventa');
    }
}

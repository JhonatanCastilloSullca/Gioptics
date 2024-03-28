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

class MedidaCreate implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $medidas;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Medida $medidas)
    {
        $medidas=DB::table('medidas as m')
        ->join('pacientes as p','m.idPaciente','=','p.id')
        ->join('users as u','m.idUsuario','=','u.id')
        ->select('m.id','p.nombre as paciente','u.nombre as usuario','p.tipo_documento','p.num_documento')
        ->where('m.estado','=','Pendiente')
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
        
        return new Channel('medidacreate');
    }
}

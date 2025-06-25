<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Cliente;
use Illuminate\Support\Facades\Http;

class EnviarDni extends Component
{

    public $titule;
    public $search = '';

    public $nuevonombrerazon;
    public $nuevonombrecomercial;
    public $nuevodireccion;
    public $mensaje = '';


    public function render()
    {
        $dni = $this->search;
        $razonsocial = "";

        $token = config('services.apisunat.token');
        $urldni = config('services.apisunat.urldni');
        $host = 'api.apis.net.pe';
        if($dni =="")
        {
            $this->mensaje = '';
        }
        else{
            if (gethostbyname($host) == $host) {
                session()->flash('success', 'No hay conexión a Internet. Por favor, verifica tu conexión y vuelve a intentarlo.');
                $this->mensaje = '';
            } else {
                try {
                    $response = Http::timeout(10)->withHeaders([
                        'Referer' => 'http://apis.net.pe/api-ruc',
                        'Authorization' => 'Bearer ' . $token
                    ])->get($urldni . $dni);
                    $persona = ($response->json());
                    if (isset($persona['error']) || $persona == "") {
                        if (isset($persona['error'])) {
                            $this->mensaje ="Se necesita 8 digitos";
                        }
                        if ($persona == "") {
                            $this->mensaje="No se encontro datos";
                        }
                    } else {
                        $razonsocial = $persona['nombres'];
                        $this->mensaje = '';
                    }
                } catch (RequestException $e) {
                    if ($e->getCode() === CURLE_OPERATION_TIMEOUTED) {
                        $this->mensaje = '';
                    } else {
                        $this->mensaje = '';
                    }
                }
            }
        }
        return view('livewire.enviar-dni', ["razonsocial" => $razonsocial, "mensaje" => $this->mensaje]);
    }



}

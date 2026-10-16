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
                session()->flash('error', 'No hay conexión a Internet. Por favor, verifica tu conexión.');
                $this->mensaje = '';
            } else {
                try {
                    $response = Http::timeout(10)->withHeaders([
                        'Referer' => 'http://apis.net.pe/api-ruc'
                    ])->get($urldni . $dni);

                    $persona = $response->json();

                    if (!$response->successful()) {
                        $this->mensaje = $persona['message'] ?? 'Error al consultar el DNI';
                    } elseif (isset($persona['error'])) {
                        $this->mensaje = $persona['message'] ?? 'Error en la consulta';
                    } elseif (isset($persona['message']) && !isset($persona['nombre'])) {
                        $this->mensaje = $persona['message'];
                    } elseif (!is_array($persona) || empty($persona['nombre'])) {
                        $this->mensaje = 'No se encontraron datos para este DNI';
                    } else {
                        $razonsocial = $persona['nombre'];
                        $this->mensaje = '';
                    }

                } catch (\Illuminate\Http\Client\ConnectionException $e) {
                    $this->mensaje = 'No se pudo conectar con el servicio de consulta DNI.';
                } catch (\Exception $e) {
                    $this->mensaje = 'Ocurrió un error al consultar el DNI.';
                }
            }
        }
        return view('livewire.enviar-dni', ["razonsocial" => $razonsocial, "mensaje" => $this->mensaje]);
    }



}

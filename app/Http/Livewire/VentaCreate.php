<?php

namespace App\Http\Livewire;

use App\Models\Cliente;
use App\Models\Company;
use App\Models\DetalleVenta;
use App\Models\Documento;
use App\Models\DocumentoSunat;
use App\Models\Venta;
use App\Services\SunatService;
use Greenter\Report\XmlUtils;
use Illuminate\Support\Facades\Http;
use Livewire\Component;
use DB;
use Carbon\Carbon;

class VentaCreate extends Component
{
    public $tipo_documento;
    public $clienteId;
    public $clientes;

    public $nuevotipo_documento;
    public $nuevodocumento;
    public $nuevonombrerazon;
    public $nuevotelefono;
    public $nuevodireccion;
    public $nuevocorreo;

    public $total=0;

    public $cont = 0;
    public $search;
    public $detalleProductos=[];
    public $issearchClienteEmpty = false;

    public $documento;
    public $mensaje = '';
    public $searchDocumento;
    public $nombrerazon;
    public $numedoc1;
    public $medioId=1;
    public $totalpago=0;
    public $medios;
    public $documentos;

    public $descripcion;
    public $precio=0;
    public $cantidad=1;

    public function mount()
    {
        $this->clientes = Cliente::get();
        $this->documentos = Documento::where('sucursal_id',\Auth::user()->idSucursal)->where('nombre','!=','NOTA DE CRÉDITO')->get();
    }

    public function agregarCliente()
    {
        $this->validate([
            'nuevotipo_documento' => 'required',
            'nuevodocumento' => 'required|max:15',
            'nuevonombrerazon' => 'required|max:150',
            'nuevodireccion' => 'nullable|max:255',
            'nuevotelefono' => 'nullable|max:50',
            'nuevocorreo' => 'nullable|email|max:250',
        ]);

        $cliente=Cliente::create([
            'tipo_documento' => $this->nuevotipo_documento,
            'num_documento' => $this->nuevodocumento,
            'nombre' => $this->nuevonombrerazon,
            'celular' => $this->nuevotelefono,
            'direccion' => $this->nuevodireccion,
            'email' => $this->nuevocorreo,
            'sunat' => $this->nuevotipo_documento == 'DNI' ? '1':'6',
        ]);
        $this->clientes = Cliente::get();
        session()->flash('danger', 'Cliente agregado Correctamente.');
        $this->clienteId = $cliente->id;
        $this->emit('close-modal', $cliente->id, $this->clientes->toArray());
    }

    public function searchDocumento()
    {
        if ($this->nuevotipo_documento == 'DNI') {
            $cliente = Cliente::where('num_documento', $this->nuevodocumento)->first();
            if ($cliente) {
                $this->nuevonombrerazon = $cliente->nombre;
                $this->nuevotelefono = $cliente->celular;
                $this->nuevodireccion = $cliente->direccion;
                $this->nuevocorreo = $cliente->email;
                $this->mensaje = '';
            } else {
                $this->searchDNIInAPI($this->nuevodocumento);
                $this->mensaje = $cliente?->nombre ? '' : 'Este cliente no está registrado en nuestra base de datos DNI';
            }
        } elseif ($this->nuevotipo_documento == 'RUC') {
            $cliente = Cliente::where('num_documento', $this->nuevodocumento)->first();
            if ($cliente) {
                $this->nuevonombrerazon = $cliente->nombre;
                $this->nuevotelefono = $cliente->celular;
                $this->nuevodireccion = $cliente->direccion;
                $this->nuevocorreo = $cliente->email;
                $this->mensaje = '';
            } else {
                $this->searchRUCInAPI($this->nuevodocumento);
                $this->mensaje = $cliente?->nombre ? '' : 'Este cliente no está registrado en nuestra base de datos RUC';
            }
        }
    }

    public function searchInAPI($documento)
    {
        $length = strlen($documento);
        if ($length == 8) {
            $this->searchDNIInAPI($documento);
        } elseif ($length == 11) {
            $this->searchRUCInAPI($documento);
        } else {
            session()->flash('success', 'El número de documento debe tener 8 o 11 dígitos');
            $this->mensaje = '';
        }
    }

    public function searchDNIInAPI($dni)
    {
        $token = config('services.apisunat.token');
        $urldni = config('services.apisunat.urldni');
        $host = 'api.apis.net.pe';
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
                    $this->numedoc1 = $dni;
                    if (isset($persona['error'])) {

                        session()->flash('success', 'Se necesita 8 digitos');
                        $this->nuevonombrerazon ="";
                        $this->nuevodireccion = '';
                        $this->mensaje ="";
                    }
                    if ($persona == "") {
                        session()->flash('success', 'No se encontro datos');
                        $this->mensaje="";
                    }
                    $this->mensaje="";
                } else {
                    $this->mensaje ="";
                    $this->nuevonombrerazon = $persona['nombre'];
                    $this->nuevodireccion = $persona['direccion'];
                }
            } catch (RequestException $e) {
                if ($e->getCode() === CURLE_OPERATION_TIMEOUTED) {
                    session()->flash('success', 'Se ha superado el límite de tiempo de la solicitud. Por favor, inténtalo de nuevo más tarde.');
                    $this->mensaje = '';
                } else {
                    session()->flash('success', 'Ocurrió un error al consumir la API:');
                    $this->mensaje = '';
                }
            }
        }
    }

    public function searchRUCInAPI($ruc)
    {
        $token = config('services.apisunat.token');
        $urlruc = config('services.apisunat.urlruc');
        $host = 'api.apis.net.pe';

        if (gethostbyname($host) == $host) {
            session()->flash('success', 'No hay conexión a Internet. Por favor, verifica tu conexión y vuelve a intentarlo.');
            $this->mensaje = '';
        } else {
            try {
                $response = Http::timeout(10)->withHeaders([
                    'Referer' => 'http://apis.net.pe/api-ruc',
                    'Authorization' => 'Bearer ' . $token
                ])->get($urlruc . $ruc);

                $persona = ($response->json());

                if ($persona == "" || isset($persona['error'])) {
                    $this->nuevonombrerazon = "";
                    $this->nuevodireccion = '';
                    if ($persona['error'] == "RUC invalido") {
                        session()->flash('success', 'RUC invalido');
                        $this->mensaje = '';
                    }
                    if ($persona['error'] == "RUC debe contener 11 digitos") {
                        session()->flash('success', 'RUC debe contener 11 digitos');
                        $this->mensaje = '';
                    }
                } else {
                    $this->mensaje ="";

                    $this->nuevonombrerazon = $persona['nombre'];
                    $this->nuevodireccion = $persona['direccion'];
                }
            } catch (RequestException $e) {
                if ($e->getCode() === CURLE_OPERATION_TIMEOUTED) {
                    session()->flash('success', 'Se ha superado el límite de tiempo de la solicitud. Por favor, inténtalo de nuevo más tarde.');
                    $this->mensaje = '';
                } else {
                    session()->flash('success', 'Ocurrió un error al consumir la API:');
                    $this->mensaje = '';
                }
            }
        }
    }

    public function agregarProducto()
    {
        $this->validate([
            'cantidad'             => 'required',
            'descripcion'        => 'required',
            'precio'        => 'required',
        ]);

        $detalle = [
            'cantidad' => $this->cantidad,
            'descripcion' => $this->descripcion,
            'precio' => $this->precio,
            'subtotal' => $this->precio*$this->cantidad,
        ];

        $this->detalleProductos[] = $detalle;

        $this->descripcion = '';
        $this->cantidad = 1;
        $this->precio = 0;
        $this->calcularTotal();
    }

    public function editarProducto($index)
    {
        $this->descripcion = $this->detalleProductos[$index]['descripcion'];
        $this->cantidad = $this->detalleProductos[$index]['cantidad'];
        $this->precio = $this->detalleProductos[$index]['precio'];
        unset($this->detalleProductos[$index]);
        $this->detalleProductos = array_values($this->detalleProductos);
    }

    public function eliminarProducto($index)
    {
        unset($this->detalleProductos[$index]);
        $this->detalleProductos = array_values($this->detalleProductos);
        $this->calcularTotal();
    }

    public function validarventa()
    {
        $this->validate([
            'clienteId'             => 'required|exists:clientes,id',
            'tipo_documento'        => 'required',
        ]);
    }

    public function registrarVenta()
    {
        $this->validarventa();

        try
        {
            DB::beginTransaction();

            $mytime= Carbon::now('America/Lima');
            $documento = Documento::find($this->tipo_documento);
            $documento->cantidad = $documento->incremento + $documento->cantidad;
            $documento->save();
            $venta = new Venta();
            $venta->nume_doc = $documento->cantidad;
            $venta->fecha = $mytime->toDateTimeString();
            $venta->idSucursal = \Auth::user()->sucursal->id;
            $venta->idUsuario = \Auth::user()->id;
            $venta->idCliente = $this->clienteId;
            $venta->documento_id = $this->tipo_documento;
            $venta->idMedios = 1;
            $venta->descuento = 0;
            $venta->acuenta = $this->total;
            $venta->saldo = 0;
            $venta->total = $this->total;
            $venta->observacion = '';
            $venta->factura = 1;
            $venta->estado = '1';
            $venta->save();
            
            foreach($this->detalleProductos as $i => $detalle)
            {
                DetalleVenta::create([
                    'idVenta' => $venta->id,
                    'cantidad' => $detalle['cantidad'],
                    'especificacion' => $detalle['descripcion'],
                    'precio' => $detalle['precio'],
                ]);
            }

            if($documento->nombre == 'BOLETA DE VENTA ELECTRÓNICA' || $documento->nombre == 'FACTURA ELECTRÓNICA'){

                $company = Company::find(1); 
                $totales = collect([
                    'MtoOperGravadas' => $venta->detalleventas()->sum(\DB::raw('cantidad * precio')) / 1.18,
                    'MtoIGV' => ($venta->detalleventas()->sum(\DB::raw('cantidad * precio')) / 1.18) * 0.18,
                    'TotalImpuestos' => ($venta->detalleventas()->sum(\DB::raw('cantidad * precio')) / 1.18) * 0.18,
                    'ValorVenta' => $venta->detalleventas()->sum(\DB::raw('cantidad * precio')) / 1.18,
                    'SubTotal' => $venta->detalleventas()->sum(\DB::raw('cantidad * precio')) / 1.18 + (($venta->detalleventas()->sum(\DB::raw('cantidad * precio')) / 1.18) * 0.18),
                    'MtoImpVenta' => $venta->detalleventas()->sum(\DB::raw('cantidad * precio')) / 1.18 + (($venta->detalleventas()->sum(\DB::raw('cantidad * precio')) / 1.18) * 0.18),
                ]);

                $sunat = new SunatService();
                $see = $sunat->getSee($company);
                $invoice = $sunat->getInvoice($company,$documento,$venta,$totales);

                $result = $see->send($invoice);

                $response['xml'] = $see->getFactory()->getLastXml();
                $response['hash'] = (new XmlUtils())->getHashSign($response['xml']);
                $response['sunatResponse'] = $sunat->sunatResponse($result);
                $documentoSunat = DocumentoSunat::create([
                    'xml' => $response['xml'],
                    'hash' => $response['hash'],
                    'respuesta' => $response['sunatResponse']['success'],
                    'codeError' => $response['sunatResponse']['error']['code'] ?? null,
                    'messageError' => $response['sunatResponse']['error']['message'] ?? null,
                    'cdrZip' => $response['sunatResponse']['cdrZip'] ?? null,
                    'codeCdr' => $response['sunatResponse']['cdrResponse']['code'] ?? null,
                    'descripcionCdr' => $response['sunatResponse']['cdrResponse']['descripcion'] ?? null,
                    'notesCdr' => isset($response['sunatResponse']['cdrResponse']['notes']) 
                                    ? json_encode($response['sunatResponse']['cdrResponse']['notes'])
                                    : null,
                    'venta_id' => $venta->id,
                ]);

                if($response['sunatResponse']['success']){
                    $venta->sunat = 1;
                    $venta->save();
                }else{
                    $venta->sunat = 0;
                    $venta->save();
                }
            }

            DB::commit();
        }
        catch(Exception $e)
        {
            DB::rollBack();
        }

        $this->emit('abrirVenta', $venta->id);        
        return redirect()->route('facturacion.lista')
            ->with('success', 'Guardado Correctamente.');
    }

    public function calcularTotal()
    {
        $total=0;
        foreach($this->detalleProductos as $i => $detalle)
        {
            $total += $detalle['subtotal'];
        }
        $this->total = $total;
    }

    public function abrirmodalcliente()
    {
        $this->emit('abrirmodalcliente');
    }

    public function render()
    {
        return view('livewire.venta-create');
    }
}

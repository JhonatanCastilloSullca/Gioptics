<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
use App\Models\Saldo;
use App\Models\Caja;

class SaldoController extends Controller
{
    public function index(Request $request)
    {
        $ventas=DB::table('ventas as v')
        ->join('clientes as p','v.idCliente','=','p.id')
        ->join('users as u','v.idUsuario','=','u.id')
        ->join('medios as m','v.idMedios','=','m.id')
        ->join('sucursals as s','v.idSucursal','=','s.id')
        ->select('v.id','p.nombre as cliente','p.celular as celular','u.nombre as vendedor','m.nombre as medio','m.banco','s.nombre as sucursal','v.acuenta','v.saldo','v.total','v.estado','v.fecha','v.descuento','s.direccion')
        ->where('v.estado','=','Registrado')
        ->where('v.idSucursal','=',\Auth::user()->idSucursal)
        ->orWhere('v.estado','=','Listo')
        ->where('v.idSucursal','=',\Auth::user()->idSucursal)
        ->get();
        $detalles=DB::table('detalle_ventas as dv')
        ->join('productos as p','dv.idProducto','=','p.id')
        ->join('categorias as c','p.categoria_id','=','c.id')
        ->join('ventas as v','dv.idVenta','=','v.id')
        ->select('dv.id','v.id as idVenta','p.nombre as producto','c.nombre as categoria')
        ->where('v.estado','=','Registrado')
        ->where('v.idSucursal','=',\Auth::user()->idSucursal)
        ->orWhere('v.estado','=','Listo')
        ->where('v.idSucursal','=',\Auth::user()->idSucursal)
        ->get();
        $usuario=DB::table('users as u')->join('sucursals as s','u.idSucursal','=','s.id')
        ->where('u.id','=',\Auth::user()->id)
        ->select('u.id','u.nombre','s.nombre as sucursal')
        ->get();
        $medios=DB::table('medios')
        ->orderBy('medios.id','desc')
        ->get();
        return view('saldo.index',["ventas"=>$ventas,"usuario"=>$usuario,"medios"=>$medios,"detalles"=>$detalles]);
    }
    public function entregados(Request $request)
    {
        $mytime= Carbon::now('America/Lima');
        $fecha=date("Y-m-d",strtotime($mytime."+ - 30 days"));

        $ventasf=DB::table('ventas as v')
        ->join('clientes as p','v.idCliente','=','p.id')
        ->join('users as u','v.idUsuario','=','u.id')
        ->join('medios as m','v.idMedios','=','m.id')
        ->join('sucursals as s','v.idSucursal','=','s.id')
        ->select('v.id','p.nombre as cliente','p.celular as celular','u.nombre as vendedor','m.nombre as medio','m.banco','s.nombre as sucursal','v.acuenta','v.saldo','v.total','v.estado','v.fecha','v.descuento','s.direccion')
        ->where('v.estado','=','Entregado')
        ->where('v.idSucursal','=',\Auth::user()->idSucursal)
        ->where('v.fecha','>',$fecha)
        ->orderBy('v.id','desc')
        ->get();
        $detalles=DB::table('detalle_ventas as dv')
        ->join('productos as p','dv.idProducto','=','p.id')
        ->join('ventas as v','dv.idVenta','=','v.id')
        ->select('dv.id','v.id as idVenta','p.nombre as producto')
        ->where('v.estado','=','Entregado')
        ->get();
        $usuario=DB::table('users as u')->join('sucursals as s','u.idSucursal','=','s.id')
        ->where('u.id','=',\Auth::user()->id)
        ->select('u.id','u.nombre','s.nombre as sucursal')
        ->get();
        $medios=DB::table('medios')
        ->orderBy('medios.id','desc')
        ->get();
         $pacientes=DB::table('pacientes')
        ->where('pacientes.id','>',1)  
        ->orderBy('pacientes.id','desc')
        ->get();
        return view('saldo.entregados',["ventasf"=>$ventasf,"usuario"=>$usuario,"medios"=>$medios,"detalles"=>$detalles,"pacientes"=>$pacientes]);
    }

    public function store(Request $request){
        $mytime= Carbon::now('America/Lima');


        $saldo= new Saldo();
        $saldo->idUsuario = \Auth::user()->id;
        if($request->idMedios != '0'){
            $saldo->idMedios = $request->idMedios;
        }else
        {
            $saldo->idMedios='1';
        }
        $saldo->idVenta = $request->id_venta;
        $saldo->fecha = $mytime->toDateTimeString();
        $saldo->monto = $request->monto;
        $saldo->idSucursal = \Auth::user()->idSucursal;
        $saldo->save();

        $ventas = DB::table('ventas as v')
        ->join('clientes as p','v.idCliente','=','p.id')
        ->join('sucursals as s','v.idSucursal','=','s.id')
        ->select('v.id','p.nombre as cliente','p.celular as celular','s.direccion','v.saldo')
        ->where('v.id','=',$request->id_venta)->get();
            foreach($ventas as $ven){
            $venta = [
                'estado'  =>  'Entregado',
                'saldo'  =>  $ven->saldo - $request->monto,
            ];
            DB::table('ventas')->where('id',$request->id_venta)->update($venta);
        }

        $detalles=DB::table('detalle_ventas as dv')
        ->join('productos as p','dv.idProducto','=','p.id')
        ->join('categorias as c','p.categoria_id','=','c.id')
        ->join('ventas as v','dv.idVenta','=','v.id')
        ->select('dv.id','v.id as idVenta','p.nombre as producto','c.nombre as categoria')
        ->where('dv.idVenta','=',$request->id_venta)
        ->get();

        $cajas= new Caja();
        $cajas->descripcion =   "PAGO SALDO";
        $cajas->documento =   "BT";
        $cajas->numero =   $request->id_venta;
        $cajas->fecha =         $mytime->toDateTimeString();
        $cajas->monto =         $request->monto;
        $cajas->tipo =          "Ingreso";
        $cajas->idUsuario =     \Auth::user()->id;
        $cajas->idSucursal =     \Auth::user()->idSucursal;
        $cajas->idMedios =      $saldo->idMedios;      
        $cajas->estado = "1";
        $cajas->save();

        $cadena="";
        foreach($detalles as $det){
            $cadena="".$cadena." ".$det->categoria.", ";
        }
        $saldo=$request->total_pagar - $request->acuenta;
        foreach($ventas as $vet){
            echo '
            <script>
            location.href= "saldo";
                window.open("https://api.whatsapp.com/send?phone=51'.$vet->celular.'&text=%0A *HOLA '.$vet->cliente.'*%0A%0ATu pedido de '.$cadena.' acaba de ser entregado. ¡Esperamos que lo disfrutes! Recuerda que todos nuestros productos tienen garantía de un año por lo que si tienes algún inconveniente puedes acercarte a nuestra tienda de '.$vet->direccion.' y te atenderemos sin costo alguno. ¡Hasta pronto!","_blank");
                
            </script>';
        }


    }
}

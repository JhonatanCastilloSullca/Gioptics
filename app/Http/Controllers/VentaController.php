<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Venta;
use App\Models\Caja;
use App\Models\DetalleVenta;
use App\Models\Producto;
use App\Models\Cliente;
use Illuminate\Support\Facades\Redirect;
use Carbon\Carbon;
use DB;

class VentaController extends Controller
{
    public function index(Request $request)
    {
        $ventas=DB::table('ventas as v')->join('clientes as p','v.idCliente','=','p.id')
        ->join('users as u','v.idUsuario','=','u.id')->join('medios as m','v.idMedios','=','m.id')
        ->join('sucursals as s','v.idSucursal','=','s.id')
        ->select('v.id','p.nombre as cliente','u.nombre as vendedor','m.nombre as medio','m.banco','s.nombre as sucursal'
        ,'v.acuenta','v.saldo','v.total','v.estado','v.fecha','v.descuento')
        ->where('v.estado','!=','Falta')
        ->get();
        $usuario=DB::table('users as u')->join('sucursals as s','u.idSucursal','=','s.id')
        ->where('u.id','=',\Auth::user()->id)
        ->select('u.id','u.nombre','s.nombre as sucursal')
        ->get();
         $pacientes=DB::table('pacientes')
        ->where('pacientes.id','>',1)  
        ->orderBy('pacientes.id','desc')
        ->get();
        return view('venta.index',["ventas"=>$ventas,"usuario"=>$usuario,"pacientes"=>$pacientes]);
    }

    
    public function venta($id)
    {
        $ventas::table('ventas as v')
        ->join('clientes as c','v.idCliente','=','c.id')
        ->join('users as u','v.idUsuario','=','u.id')
        ->join('medios as m','v.idMedios','=','m.id')
        ->join('sucursals as su','v.idSucursal','=','su.id')
        ->select('clientes.nombre as cliente','users.nombre as personal','medios.nombre as medios','sucursal.nombre as sucursal','v.fecha','v.descuento','v.acuenta','v.saldo','v.total','v.observacion')
        ->where('v.id','=',$id)
        ->orderBy('v.id','desc')        
        ->get();

        $usuarios=DB::table('users')
        ->orderBy('users.id','desc')
        ->get();
        $clientes=DB::table('clientes')
        ->orderBy('clientes.id','desc')
        ->get();
        $usuario=DB::table('users as u')->join('sucursals as s','u.idSucursal','=','s.id')
        ->where('u.id','=',\Auth::user()->id)
        ->select('u.id','u.nombre','s.nombre as sucursal')
        ->get();

        $pdf= \PDF::loadView('pdf.recetapdf',['ventas' => $ventas])->setPaper('a5','landscape');
        return $pdf->stream('recetapdf'.$id.'.pdf');        
    }

    public function create()
    {
        $clientes=DB::table('clientes')->where('clientes.id','>',0)->orderBy('clientes.id','desc')->get();
        $medios=DB::table('medios')->where('medios.estado','=','1')->orderBy('medios.nombre','desc')->get();
        $usuario=DB::table('users as u')->join('sucursals as s','u.idSucursal','=','s.id')
        ->where('u.id','=',\Auth::user()->id)
        ->select('u.id','u.nombre','s.nombre as sucursal')
        ->get();
        $productos=Producto::where('stock','>','0')->get();

        $mytime= Carbon::now('America/Lima');
        $medidas2=DB::table('medidas as m')
        ->where('m.estado','=','Registrado')->where('m.id','>','1')->orderBy('m.id','asc')->get();
        $medida=DB::table('medidas as m')->join('pacientes as p','m.idPaciente','=','p.id')
        ->select('m.id','p.nombre as paciente','p.num_documento','p.tipo_documento','p.celular','p.email','m.idPaciente')->orderBy('m.id','asc')->get();
        $medidas = $medida->unique('idPaciente');
        $cliente = Cliente::select('id')->orderBy('id', 'desc')->first();
        $ultimo=$cliente->id+1;
        return view('venta.create',compact('clientes','medios','usuario','medidas2','productos','medidas','ultimo'));
    }

    public function store(Request $request)
    {
        try{
            DB::beginTransaction();
            $requ=\Validator::make($request->all(), [
                'idCliente' => 'required',
                'idMedios' => 'required',
                'observacion' => 'nullable',
            ]);
            if ($requ->fails())
            {
                return Redirect::back()->with('error_code', 6)->withErrors($requ->errors())->withInput();
    
            }

            $mytime= Carbon::now('America/Lima');
            
            $venta = new Venta();
            $venta->idCliente = $request->idCliente;
            $venta->idUsuario = \Auth::user()->id;
            $venta->idMedios = $request->idMedios;
            $venta->idSucursal = \Auth::user()->idSucursal;
            $venta->fecha = $mytime->toDateTimeString();
            $venta->acuenta = $request->acuenta;
            if($request->valor_descuento=="%"){

                $venta->descuento=($request->descuento*$request->total_pagar)/100;
                $venta->total=$request->total_pagar-$venta->descuento;
                $venta->saldo = $venta->total - $request->acuenta;
            }else{
                $venta->descuento=$request->descuento;
                $venta->total=$request->total_pagar-$venta->descuento;
                $venta->saldo = $venta->total - $request->acuenta;
            }
            $venta->observacion =$request->observacion;
            $venta->estado = "Registrado";
            $venta->save();

            $id_producto=$request->id_productoe;
            $cantidad=$request->cantidade;
            $precio=$request->precioe;
            $idMedida=$request->id_pacientee;

            $cont=0;

            while($cont < count($id_producto)){

                $detalle = new DetalleVenta();
                $detalle->idventa = $venta->id;
                $detalle->idproducto = $id_producto[$cont];
                $detalle->cantidad = $cantidad[$cont];
                $detalle->precio = $precio[$cont];
                $detalle->idMedidas = $idMedida[$cont];
                $detalle->save();

                $detalle2 = DB::table('productos')->join('categorias as c','productos.categoria_id','=','c.id')
                ->where('productos.id','=',$detalle->idproducto)
                ->select('productos.stock','c.tipo')
                ->orderBy('productos.id','desc')->get();
                foreach($detalle2 as $det){

                    if($det->tipo=="CON STOCK")  {
                        $productos = [
                            'stock'  =>  $det->stock- $detalle->cantidad,
                        ];
                        DB::table('productos')->where('id',$detalle->idproducto)->update($productos);
                    }
                    
                }
                $medidas = DB::table('medidas as m')
                ->where('m.id','=',$detalle->idMedidas)->get();
                foreach($medidas as $med){

                    if($med->id != 1)  {
                        $medida = [
                            'estado'  =>  'Finalizado',
                        ];
                        DB::table('medidas')->where('id',$detalle->idMedidas)->update($medida);
                    }
                    
                }
                $cont=$cont+1;

                $cajas= new Caja();
                $cajas->descripcion =   "VENTAS";
                $cajas->documento =   'OT';
                $cajas->numero =   $venta->id;
                $cajas->fecha =         $mytime->toDateTimeString();
                $cajas->monto =         $venta->acuenta;
                $cajas->tipo =          "Ingreso";
                $cajas->idUsuario =     \Auth::user()->id;
                $cajas->idSucursal =     \Auth::user()->idSucursal;
                $cajas->idMedios =      $request->idMedios;      
                $cajas->estado = "1";
                $cajas->save();

                
            }
                
            DB::commit();

        } catch(Exception $e){
            
            DB::rollBack();
        }

        return Redirect::to('saldo');
    }
    public function show($id)
    {
        $ventas=DB::table('ventas as v')->join('clientes as p','v.idCliente','=','p.id')
        ->join('users as u','v.idUsuario','=','u.id')->join('medios as m','v.idMedios','=','m.id')
        ->join('sucursals as s','v.idSucursal','=','s.id')
        ->select('v.id','p.nombre as cliente','u.nombre as vendedor','m.nombre as medio','m.banco','s.nombre as sucursal'
        ,'v.acuenta','v.saldo','v.total','v.estado','v.fecha','v.descuento','v.observacion')
        ->where('v.id','=',$id)
        ->get();

        $detalles=DB::table('detalle_ventas as dv')->join('ventas as v','dv.idVenta','v.id')
        ->join('productos as p','dv.idProducto','=','p.id')->join('medidas as m','dv.idMedidas','=','m.id')
        ->join('pacientes as pa','m.idPaciente','=','pa.id')
        ->select('dv.id','p.nombre as producto','dv.cantidad','dv.precio','p.codigo','pa.nombre as paciente','dv.especificacion')
        ->where('v.id','=',$id)
        ->get();
        $usuario=DB::table('users as u')->join('sucursals as s','u.idSucursal','=','s.id')
        ->where('u.id','=',\Auth::user()->id)
        ->select('u.id','u.nombre','s.nombre as sucursal')
        ->get();
        $saldo=DB::table('saldos as s')->join('ventas as v','s.idVenta','v.id')->join('medios as m','s.idMedios','=','m.id')
        ->join('users as u','v.idUsuario','=','u.id')
        ->select('s.id','m.nombre as medio','u.nombre as usuario','m.banco','s.fecha','s.monto')
        ->where('v.id','=',$id)
        ->get();
         $pacientes=DB::table('pacientes')
        ->where('pacientes.id','>',1)  
        ->orderBy('pacientes.id','desc')
        ->get();
        return view('venta.show',['ventas' => $ventas,'detalles' =>$detalles,"usuario"=>$usuario,"saldo"=>$saldo,"pacientes"=>$pacientes]);
    }
    
    public function destroy(Request $request)
    {   
        if($request->id_estado==1){
            $venta = Venta::findOrFail($request->id_venta2);
            if($venta->estado=="Registrado"){
                $venta->estado = 'Listo';
                $venta->save();
            }else{
                $venta->estado = 'Registrado';
                $venta->save();
            }
            return Redirect::to('saldo');
        }else{
            
            $venta = Venta::findOrFail($request->id_venta);
            $venta->estado = 'Anulado';
            $venta->save();

            $productos = DB::table('productos as p')->join('detalle_ventas as dv','dv.idProducto','=','p.id')
            ->join('ventas as v','dv.idVenta','v.id')->join('categorias as c','p.categoria_id','=','c.id')
            ->where('v.id','=',$request->id_venta)
            ->select('p.id','p.stock','c.tipo','dv.cantidad')->get();
            $ingresos = Caja::where('cajas.documento','=',$request->id_venta)->firstOrFail();
            $ingresos->estado = 'Anulado';
            $ingresos->save();

            foreach($productos as $pro){

                if($pro->tipo=="CON STOCK")  {
                    $producto = [
                        'stock'  =>  $pro->stock + $pro->cantidad,
                    ];
                    DB::table('productos')->where('id',$pro->id)->update($producto);
                }
                
            }

            return Redirect::to('venta');
        }
    }


    
     public function ventapdf($id)
    {
        $medidas=DB::table('medidas as m')
        ->join('pacientes as p','m.idPaciente','=','p.id')
        ->join('users as u','m.idUsuario','=','u.id')
        ->select('m.id','p.nombre as paciente','u.nombre as usuario')
        ->where('m.id','=',$id)
        ->orderBy('m.id','desc')        
        ->get();

        $usuarios=DB::table('users')
        ->orderBy('users.id','desc')
        ->get();
        $pacientes=DB::table('pacientes')
        ->orderBy('pacientes.id','desc')
        ->get();
        $usuario=DB::table('users as u')->join('sucursals as s','u.idSucursal','=','s.id')
        ->where('u.id','=',\Auth::user()->id)
        ->select('u.id','u.nombre','s.nombre as sucursal')
        ->get();

         $ventas=DB::table('ventas as v')
        ->join('clientes as p','v.idCliente','=','p.id')
        ->join('users as u','v.idUsuario','=','u.id')
        ->join('medios as m','v.idMedios','=','m.id')
        ->join('sucursals as s','v.idSucursal','=','s.id')
        ->select('v.id','p.nombre as cliente','p.celular as celcliente','u.nombre as vendedor','m.nombre as medio','m.banco','s.nombre as sucursal'
        ,'v.acuenta','v.descuento','v.saldo','v.total','v.fecha','v.estado')
        ->where('v.id','=',$id)
        ->get();

        $detalles=DB::table('detalle_ventas as dv')
        ->join('ventas as v','dv.idVenta','v.id')
        ->join('productos as p','dv.idProducto','=','p.id')
        ->join('categorias as cat','p.categoria_id','=','cat.id')
        ->join('medidas as m','dv.idMedidas','=','m.id')
        ->join('pacientes as pa','m.idPaciente','=','pa.id')
        ->select('dv.id','cat.nombre as producto','dv.cantidad','dv.precio','p.codigo','pa.nombre as paciente','dv.especificacion')
        ->where('dv.idVenta','=',$id)
        ->get();
        
        


        $pdf= \PDF::loadView('pdf.ventapdf',['ventas' => $ventas,'detalles' => $detalles])->setPaper('a5','landscape');
        return $pdf->stream('ventapdf'.$id.'.pdf');


        
    }

    public function pdf(Request $request,$id)
    {
        $ventas=DB::table('ventas as v')->join('clientes as p','v.idCliente','=','p.id')
        ->join('users as u','v.idUsuario','=','u.id')->join('medios as m','v.idCliente','=','m.id')
        ->join('sucursals as s','v.idSucursal','=','s.id')
        ->select('v.id','p.nombre as cliente','u.nombre as vendedor','m.nombre as medio','m.banco','s.nombre as sucursal'
        ,'v.acuenta','v.saldo','v.total','v.estado')
        ->where('v.id','=',$id)
        ->get();

        $detalles=DB::table('detalle_ventas as dv')->join('productos as p','dv.idProducto','=','p.id')
        ->select('dv.id','p.nombre as producto','v.cantidad','v.precio')
        ->where('dv.id','=',$id)
        ->get();
        
        $pdf= \PDF::loadView('pdf.venta',['venta'=>$venta,'detalles'=>$detalles]);
        return $pdf->download('venta.pdf');
    }
}

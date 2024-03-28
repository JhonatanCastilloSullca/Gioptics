<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Compra;
use App\Models\Saldoc;
use App\Models\DetalleCompra;
use App\Models\Medio;
use App\Models\Categoria;
use App\Models\Sucursal;
use App\Models\Unidad;
use App\Models\Proveedor;
use Illuminate\Support\Facades\Redirect;
use Carbon\Carbon;
use DB;

class CompraController extends Controller
{
    public function index(Request $request)
    {
        $compras=DB::table('compras as c')
        ->join('medios as med','c.idMedios','=','med.id')
        ->join('proveedors as prove','c.idMedios','=','prove.id')
        ->join('users as us','c.idUsuario','=','us.id')
        ->join('sucursals as su','c.idSucursal','=','su.id')
        ->select('c.id','prove.id as idprove','prove.nombre as nombreprove','us.nombre as usuario','med.nombre as medio'
        ,'med.banco as medbanco','su.nombre as sucursal','c.fecha','c.total','c.comprobante','c.estado','c.acuenta','c.saldo','c.numero')
        ->get();
        $usuario=DB::table('users as u')->join('sucursals as s','u.idSucursal','=','s.id')
        ->where('u.id','=',\Auth::user()->id)
        ->select('u.id','u.nombre','s.nombre as sucursal')
        ->get();
        $pacientes=DB::table('pacientes')
        ->where('pacientes.id','>',1)  
        ->orderBy('pacientes.id','desc')
        ->get();
        return view('compra.index',["compras"=>$compras,"usuario"=>$usuario,"pacientes"=>$pacientes]);
    }

    public function create()
    {
        $productos=DB::table('productos')->orderBy('productos.id','desc')->get();
        $medios=DB::table('medios')->where('medios.estado','=','1')->orderBy('medios.nombre','asc')->get();
        $categorias=DB::table('categorias')->where('categorias.estado','=','1')->orderBy('categorias.nombre','asc')->get();
        $proveedor=DB::table('proveedors')->where('proveedors.estado','=','ACTIVO')->orderBy('proveedors.nombre','asc')->get();
        $usuario=DB::table('users as u')->join('sucursals as s','u.idSucursal','=','s.id')
        ->where('u.id','=',\Auth::user()->id)
        ->select('u.id','u.nombre','s.nombre as sucursal')
        ->get(); 
        $pacientes=DB::table('pacientes')
        ->where('pacientes.id','>',1)  
        ->orderBy('pacientes.id','desc')
        ->get();
        return view('compra.create',["proveedor"=>$proveedor,"productos"=>$productos,"medios"=>$medios,"productos"=>$productos,"categorias"=>$categorias,"usuario"=>$usuario,"pacientes"=>$pacientes]);
    }
    public function store(Request $request)
    {        
        $mytime= Carbon::now('America/Lima');            
        $compras = new Compra();            
        $compras->idMedios = 1;
        $compras->idUsuario = \Auth::user()->id;
        $compras->idSucursal = \Auth::user()->idSucursal;            
        $compras->fecha = $mytime->toDateString();
        $compras->comprobante = "Factura";
        $compras->numero = 0;
        $compras->acuenta=0;
        $compras->saldo=0;       
        $compras->total=0;            
        $compras->estado = 'Pendiente';
        $compras->save();           
        
        return Redirect::to('compra/'.$compras->id.'/edit');
    }

    public function show($id)
    {
        $compras=Compra::where('id','=',$id)->get();

        $saldoc=DB::table('saldocs as s')->join('compras as c','s.idCompra','c.id')->join('medios as m','s.idMedios','=','m.id')
        ->select('s.id','m.nombre as medio','m.banco','s.fecha','s.monto','s.estado')
        ->where('c.id','=',$id)
        ->get();
        $usuario=DB::table('users as u')->join('sucursals as s','u.idSucursal','=','s.id')
        ->where('u.id','=',\Auth::user()->id)
        ->select('u.id','u.nombre','s.nombre as sucursal')
        ->get();
        $colspan=6;
        $medios=DB::table('medios')->where('medios.estado','=','1')->orderBy('medios.nombre','asc')->get();
        return view('compra.show',compact('compras','saldoc','usuario','colspan','medios'));
    }
    
    public function edit($id)
    {
        $medios=Medio::where('estado','1')->get();
        $categorias=Categoria::where('estado','1')->orderBy('id','asc')->get();
        $proveedor=Proveedor::where('estado','ACTIVO')->orderBy('id','asc')->get();
        $sucursales=Sucursal::where('estado','1')->orderBy('nombre','asc')->get();
        $unidades=Unidad::where('estado','1')->orderBy('id','asc')->get();
        $compra=Compra::where('id',$id)->get();
        $usuario=DB::table('users as u')->join('sucursals as s','u.idSucursal','=','s.id')
        ->where('u.id','=',\Auth::user()->id)
        ->select('u.id','u.nombre','s.nombre as sucursal')
        ->get();
        $colspan=6;
        return view('compra.edit',["colspan"=>$colspan,"compra"=>$compra,"proveedor"=>$proveedor,"sucursales"=>$sucursales,"unidades"=>$unidades,"medios"=>$medios,"categorias"=>$categorias,"usuario"=>$usuario]);
    }
    
    public function destroy(Request $request)
    {   
        $compra = Compra::findOrFail($request->id_compra);
        $compra->estado = 'Anulado';
        $compra->save();

        $productos = DB::table('productos as p')->join('detalle_compras as dc','dc.idProducto','=','p.id')
        ->join('compras as c','dc.idCompra','c.id')->join('categorias as ca','p.categoria_id','=','ca.id')
        ->where('c.id','=',$request->id_compra)
        ->select('p.id','p.stock','ca.tipo','dc.cantidad')->get();
        foreach($productos as $pro){

            if($pro->tipo=="CON STOCK")  {
                $producto = [
                    'stock'  =>  $pro->stock - $pro->cantidad,
                ];
                DB::table('productos')->where('id',$pro->id)->update($producto);
            }
            
        }

        return Redirect::to('compra');
    }
    public function update(Request $request)
    {    
        $requ=\Validator::make($request->all(), [
            'observacion' => 'nullable|string|max:500',
        ]);
        if ($requ->fails())
        {
            return Redirect::back()->with('error_code', 5)->withErrors($requ->errors())->withInput();
        }
        $saldo=$request->totalpagar-$request->acuenta;
        
        $compra2 = [
        'observacion'           =>  $request->observacion, 
        'comprobante'           =>  "Recibo",
        'idMedios'           =>  1,
        'numero'           =>  0, 
        'acuenta'           =>  0,
        'fecha'           =>  $request->fecha_enviar,
        'saldo'           =>  0,
        'total'           =>  $request->totalpagar,
        'estado'           =>  'Registrado',
        ];
            
        DB::table('compras')->where('id',$request->id_enviar)->update($compra2);     
        
        
        $compras= Compra::findOrFail($request->id_enviar);
        foreach($compras->detallecompras as $detalle)
        {
            foreach($detalle->productos as $producto)
            {
                $productonuevo = [
                    'estado'           =>  'Registrado',
                ];
                DB::table('productos')->where('id',$producto->id)->update($productonuevo);
            }
            
        }
        return Redirect::to("saldoc"); 
    }



    public function pdf(Request $request,$id)
    {
        $ventas=DB::table('ventas as v')->join('pacientes as p','v.idCliente','=','p.id')
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
        
        $pdf= \PDF::loadView('pdf.venta',['venta'=>$compra,'detalles'=>$detalles]);
        return $pdf->download('venta.pdf');
    }
}
